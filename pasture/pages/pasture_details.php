<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/pasturedetailstyle.css">
    <title>Detalhes de pasto</title>
</head>

<body>
    <?php
    include("../pastureServices/sql.php");

    //select database
    $db = mysqli_select_db($conn, $DBName);


    $id = $_SERVER['QUERY_STRING'];

    $result = mysqli_query($conn, pastureWithId($id));
    $pasture = [];

    if (isset($_POST['button1'])) {
        mysqli_query($conn, deletePastureWithId($id));
        header('location: ../../index.php');
        exit;
    }
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
    $farmName = $pasture['farmName'];

    mysqli_close($conn);

    $header =
        "<header>
        <a href='../../index.php'> Voltar </a>
        <h1>$name</h1>
        <h1>$farmName</h1>
      </header>";

    $pastureDetail =
        "<div class='pasture-item'>
        <img src='$image' alt='Imagem do boi'>
        <p>Status: $status Kg</p>
        <p>Descrição: $description</p>
        <div class='buttons'>
          <a class='pasture-btn-editar' href='pasture_edit.php?$id' >Editar Pasto</a>
          <form method='post'>
          <input type='submit' name='button1' value='Deletar' class='pasture-btn-deletar'/>
          </form>
        </div>
    </div>";

    $main = "<main> <div class='pasture-container'>" . $pastureDetail . "</div> </main>";

    $pasturePage = $header . $main;

    echo
        "<div id='pasture'>" . $pasturePage . "</div>";
    ?>
</body>

</html>