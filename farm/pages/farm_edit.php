<!DOCTYPE html>
<html lang="pt_br">

<?php
include("../farmServices/sql.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/farmcreatestyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Cadastro dos Bois</title>
</head>

<body>
    <?php
    $db = mysqli_select_db($conn, $DBName);

    $id = $_SERVER['QUERY_STRING'];

    $result = mysqli_query($conn, farmWithId($id));
    $farm = [];
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $farm = [
            "id" => $row['farmId'],
            "name" => $row['farmName'],
            "description" => $row['farmDescription'],
            "updateDate" => $row['farmUpdateDate'],
            "cadastreDate" => $row['farmCadastreDate'],
            "image" => $row['imagePath'],
            "imageId" => $row['imageId']
        ];
    }

    $id = $farm['id'];
    $name = $farm['name'];
    $description = $farm['description'];
    $updateDate = $farm['updateDate'];
    $cadastreDate = $farm['cadastreDate'];
    $image = $farm['image'];
    $imageId = $farm['imageId'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $now = date("Y-m-d H:i:s");

        $farmName = $_POST['farmName'];
        $farmDescription = $_POST['farmDescription'];
        $farmUpdateDate = $now;
        $farmCadastreDate = $cadastreDate;
        $imagePath = $_POST['imagePath'];

        $db = mysqli_select_db($conn, $DBName);

        // sql to insert data
        $sql = "UPDATE farm SET
			farmName = '$farmName',
			farmDescription = '$farmDescription',
			farmUpdateDate = '$farmUpdateDate',
			farmCadastreDate = '$farmCadastreDate'
		WHERE
            farmId = $id
		";

        mysqli_query($conn, $sql);

        $result = mysqli_query($conn, $lastBullId);
        $farmId;

        if (mysqli_num_rows($result) > 0) {

            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $farmId = $row['farmId'];
            }

        }

        $sql = "UPDATE imagem SET
			imageObjectId = '$id',
			imageObjectOfImage = 'farm',
			imagePath = '$imagePath'
		WHERE 
            imageId = $imageId
		";

        mysqli_query($conn, $sql);

        mysqli_close($conn);

        header('Location: ../../index.php');
        exit();
    }
    ?>
    <h1>Editar Fazenda</h1>
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