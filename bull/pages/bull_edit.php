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
    $db = mysqli_select_db($conn, $DBName);

    $id = $_SERVER['QUERY_STRING'];

    $result = mysqli_query($conn, bullWithId($id));
    $bull = [];
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $bull = [
            "id" => $row['bullId'],
            "pastureId" => $row['bullPastureId'],
            "farmId" => $row['bullFarmId'],
            "name" => $row['bullName'],
            "description" => $row['bullDescription'],
            "updateDate" => $row['bullUpdateDate'],
            "cadastreDate" => $row['bullCadastreDate'],
            "weightKg" => $row['bullWeightKg'],
            "weightArroba" => $row['bullWeightArroba'],
            "growthRate" => $row['bullGrowthRate'],
            "farmName" => $row["farmName"],
            "pastureName" => $row["pastureName"],
            "image" => $row["imagePath"],
            "imageId" => $row["imageId"]
        ];
    }

    $id = $bull["id"];
    $pastureId = $bull["pastureId"];
    $farmId = $bull["farmId"];
    $name = $bull["name"];
    $description = $bull["description"];
    $updateDate = $bull["updateDate"];
    $cadastreDate = $bull["cadastreDate"];
    $weightKg = $bull["weightKg"];
    $weightArroba = $bull["weightArroba"];
    $growthRate = $bull["growthRate"];
    $image = $bull["image"];
    $imageId = $bull["imageId"];
    $pastureName = $bull["pastureName"];
    $farmName = $bull["farmName"];

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
        $sql = "UPDATE bull SET
			bullPastureId = '$bullPastureId',
			bullFarmId = '$bullFarmId',
			bullName = '$bullName',
			bullDescription = '$bullDescription',
			bullUpdateDate = '$bullUpdateDate',
			bullCadastreDate = '$bullCadastreDate',
			bullWeightKg = '$bullWeightKg',
			bullWeightArroba = '$bullWeightArroba',
			bullGrowthRate = '$bullGrowthRate'
		WHERE
            bullId = $id
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

        $sql = "UPDATE imagem SET
			imageObjectId = '$id',
			imageObjectOfImage = 'bull',
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
    <h1>Editar Boi</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="bullName" required value=<?php echo "'" . $name . "'" ?>><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="bullDescription" rows="4" cols="50" ><?php echo $description ?></textarea><br>

        <label for="peso_kg">Peso (Kg):</label>
        <input type="number" id="peso_kg" name="bullWeightKg" step="0.01" required value=<?php echo "'" . $weightKg . "'" ?>><br>

        <label for="peso_arroba">Peso (@):</label>
        <input type="number" id="peso_arroba" name="bullWeightArroba" step="0.01" required value=<?php echo "'" . $weightArroba . "'" ?>><br>

        <label for="pasto">Pasto:</label>
        <select id="pasto" name="bullPastureId" value=<?php echo "'" . $pastureId . "'" ?>>
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
        <input type="text" id="imagem" name="imagePath" , value=<?php echo "'" . $image . "'" ?>><br>

        <input type="submit" value="Editar">
    </form>
    <a href="../../index.php">Voltar para o Overview</a>
</body>

</html>