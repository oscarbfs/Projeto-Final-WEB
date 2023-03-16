<!DOCTYPE html>
<html lang="pt_br">

<?php
include("../../mysqli/connection.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/farmcreatestyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Cadastro das Fazendas</title>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $now = date("Y-m-d H:i:s");

        $farmName = $_POST['farmName'];
        $farmDescription = $_POST['farmDescription'];
        $farmUpdateDate = $now;
        $farmCadastreDate = $now;
        $imagePath = $_POST['imagePath'];

        $db = mysqli_select_db($conn, $DBName);

        // sql to insert data
        $sql = "INSERT INTO farm (
			farmId,
            farmName,
            farmDescription,
            farmUpdateDate,
            farmCadastreDate
		)
		VALUES (
			NULL,
			'$farmName',
			'$farmDescription',
			'$farmUpdateDate',
			'$farmCadastreDate'
		)
		";

        echo $sql;

        mysqli_query($conn, $sql);

        $result = mysqli_query($conn, $lastFarmId);
        $farmId;

        if (mysqli_num_rows($result) > 0) {

            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $farmId = $row['farmId'];
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
			'$farmId',
			'farm',
			'$imagePath'
		)
		";

        mysqli_query($conn, $sql);

        mysqli_close($conn);

        header('Location: ../../index.php');
        exit();
    }
    ?>
    <h1>Cadastro das Fazendas</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="farmName" required><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="farmDescription" rows="4" cols="50"></textarea><br>

        <label for="imagem">Link para imagem:</label>
        <input type="text" id="imagem" name="imagePath"><br>

        <input type="submit" value="Cadastrar">
    </form>
    <a href="../../index.php">Voltar para o Overview</a>
</body>

</html>