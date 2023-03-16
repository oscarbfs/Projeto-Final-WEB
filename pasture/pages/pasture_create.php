<!DOCTYPE html>
<html lang="pt_br">

<?php
include("../../mysqli/connection.php");
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/pasturecreatestyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<title>Cadastro dos Pastos</title>
</head>

<body>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$now = date("Y-m-d H:i:s");

		$pastureFarmId = $currentFarmId ?? 1;
		$pastureName = $_POST['pastureName'];
		$pastureDescription = $_POST['pastureDescription'];
		$pastureStatus = $_POST['pastureStatus'];
		$pastureUpdateDate = $now;
		$pastureCadastreDate = $now;
		$imagePath = $_POST['imagePath'];

		$db = mysqli_select_db($conn, $DBName);

		// sql to insert data
		$sql = "INSERT INTO pasture (
			pastureId,
			pastureFarmId,
			pastureName,
			pastureDescription,
			pastureStatus,
			pastureUpdateDate,
			pastureCadastreDate
		)
		VALUES (
			NULL,
			'$pastureFarmId',
			'$pastureName',
			'$pastureDescription',
			'$pastureStatus',
			'$pastureUpdateDate',
			'$pastureCadastreDate'
		)
		";

		mysqli_query($conn, $sql);

		$result = mysqli_query($conn, $lastPastureId);
		$pastureId;

		if (mysqli_num_rows($result) > 0) {

			// output data of each row
			while ($row = mysqli_fetch_assoc($result)) {
				$pastureId = $row['pastureId'];
			}

		}

		$sql = "INSERT INTO imagem (
			imageId,
			imageObjectId,
			imageObjectOfImage,
			imagePath
		)
		VALUES (
			NULL,
			'$pastureId',
			'pasture',
			'$imagePath'
		)
		";

		mysqli_query($conn, $sql);

		mysqli_close($conn);

		header('Location: ../../index.php');
		exit();
	}
	?>
	<h1>Cadastro de Bois</h1>
	<form method="post">
		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="pastureName" required><br>

		<label for="descricao">Descrição:</label>
		<textarea id="descricao" name="pastureDescription" rows="4" cols="50"></textarea><br>

		<label for="pasto">Status:</label>
		<select id="pasto" name="pastureStatus">
			<option value='livre'>Livre</option>
			<option value='ocupado'>Ocupado</option>
			<option value='recuperação'>Em recuperação</option>
		</select><br>

		<label for="imagem">Link para imagem:</label>
		<input type="text" id="imagem" name="imagePath"><br>

		<input type="submit" value="Cadastrar">
	</form>
	<a href="../../index.php">Voltar para o Overview</a>
</body>

</html>