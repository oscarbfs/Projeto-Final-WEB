<!DOCTYPE html>
<html lang="pt_br">

<?php
include("../pastureServices/sql.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/pasturecreatestyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Cadastro dos Bois</title>
</head>

<body>
    <?php
    $db = mysqli_select_db($conn, $DBName);

    $id = $_SERVER['QUERY_STRING'];

    $result = mysqli_query($conn, pastureWithId($id));
    $pasture = [];
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $pasture = [
            "id" => $row['pastureId'],
            "farmId" => $row['pastureFarmId'],
            "name" => $row['pastureName'],
            "description" => $row['pastureDescription'],
            "status" => $row['pastureStatus'],
            "updateDate" => $row['pastureUpdateDate'],
            "cadastreDate" => $row['pastureCadastreDate'],
            "image" => $row['imagePath'],
            "imageId" => $row['imageId'],
            "farmName" => $row['farmName']
        ];
    }

    $id = $pasture['id'];
    $farmId = $pasture['farmId'];
    $name = $pasture['name'];
    $description = $pasture['description'];
    $status = $pasture['status'];
    $updateDate = $pasture['updateDate'];
    $cadastreDate = $pasture['cadastreDate'];
    $image = $pasture['image'];
    $imageId = $pasture['imageId'];
    $farmName = $pasture['farmName'];

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
        $sql = "UPDATE pasture SET
			pastureFarmId = '$pastureFarmId',
			pastureName = '$pastureName',
			pastureDescription = '$pastureDescription',
			pastureStatus = '$pastureStatus',
			pastureUpdateDate = '$pastureUpdateDate',
			pastureCadastreDate = '$pastureCadastreDate'
		WHERE
            pastureId = $id
		";

        mysqli_query($conn, $sql);

        $result = mysqli_query($conn, $lastBullId);
        $pastureId;

        if (mysqli_num_rows($result) > 0) {

            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $pastureId = $row['pastureId'];
            }

        }

        $sql = "UPDATE imagem SET
			imageObjectId = '$id',
			imageObjectOfImage = 'pasture',
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
    <h1>Editar Pasto</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="pastureName" required value=<?php echo "'" . $name . "'" ?>><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="pastureDescription" rows="4" cols="50"><?php echo $description ?></textarea><br>

        <label for="pasto">Status:</label>
        <select id="pasto" name="pastureStatus" value=<?php echo "'" . $status . "'" ?>>
            <option value='livre'>Livre</option>
            <option value='ocupado'>Ocupado</option>
            <option value='recuperação'>Em recuperação</option>
        </select><br>

        <label for="imagem">Link para imagem:</label>
        <input type="text" id="imagem" name="imagePath" value=<?php echo "'" . $image . "'" ?>><br>

        <input type="submit" value="Cadastrar">
    </form>
    <a href="../../index.php">Voltar para o Overview</a>
</body>

</html>