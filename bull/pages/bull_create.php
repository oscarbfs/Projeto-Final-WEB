<!DOCTYPE html>
<html lang="pt_br">

<?php
include("../bullServices/sql.php");
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/bullcreatestyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<title>Cadastro dos Bois</title>
</head>

<body>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$now = date("Y-m-d H:i:s");

		$bullPastureId = $_POST['bullPastureId'];
		$bullFarmId = $currentFarmId ?? 1;
		$bullName = $_POST['bullName'];
		$bullDescription = $_POST['bullDescription'];
		$bullUpdateDate = $now;
		$bullCadastreDate = $now;
		$bullWeightKg = $_POST['bullWeightKg'];
		$bullWeightArroba = $_POST['bullWeightArroba'];
		$bullGrowthRate = 0;
		$imagePath = $_POST['imagePath'];

		$db = mysqli_select_db($conn, $DBName);

		// sql to insert data
		$sql = "INSERT INTO bull (
			bullId,
			bullPastureId,
			bullFarmId,
			bullName,
			bullDescription,
			bullUpdateDate,
			bullCadastreDate,
			bullWeightKg,
			bullWeightArroba,
			bullGrowthRate
		)
		VALUES (
			NULL,
			'$bullPastureId',
			'$bullFarmId',
			'$bullName',
			'$bullDescription',
			'$bullUpdateDate',
			'$bullCadastreDate',
			'$bullWeightKg',
			'$bullWeightArroba',
			'$bullGrowthRate'
		)
		";

		mysqli_query($conn, $sql);

		$result = mysqli_query($conn, $lastBullId);
		$bullId;

		if (mysqli_num_rows($result) > 0) {

			// output data of each row
			while ($row = mysqli_fetch_assoc($result)) {
				$bullId = $row['bullId'];
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
			'$bullId',
			'bull',
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
		<input type="text" id="nome" name="bullName" required><br>

		<label for="descricao">Descrição:</label>
		<textarea id="descricao" name="bullDescription" rows="4" cols="50"></textarea><br>

		<label for="peso_kg">Peso (Kg):</label>
		<input type="number" id="peso_kg" name="bullWeightKg" step="0.01" required><br>

		<label for="peso_arroba">Peso (@):</label>
		<input type="number" id="peso_arroba" name="bullWeightArroba" step="0.01" required><br>

		<label for="pasto">Pasto:</label>
		<select id="pasto" name="bullPastureId">
			<?php
			include("../../mysqli/connection.php");

			$db = mysqli_select_db($conn, $DBName);

			$result = mysqli_query($conn, $pasturesData);

			if (mysqli_num_rows($result) > 0) {

				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value='" . $row['pastureId'] . "'>" . $row['pastureName'] . "</option>";
				}
			}
			?>
		</select><br>

		<label for="imagem">Link para imagem:</label>
		<input type="text" id="imagem" name="imagePath"><br>

		<input type="submit" value="Cadastrar">
	</form>
	<a href="../../index.php">Voltar para o Overview</a>
</body>

</html>