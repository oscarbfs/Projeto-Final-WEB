<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/farmdetailstyle.css">
    <title>Detalhes de pasto</title>
</head>

<body>
    <?php
    include("../farmServices/sql.php");

    //select database
    $db = mysqli_select_db($conn, $DBName);


    $id = $_SERVER['QUERY_STRING'];

    $result = mysqli_query($conn, farmWithId($id));
    $farm = [];

    if (isset($_POST['button1'])) {
        mysqli_query($conn, deleteFarmWithId($id));
        header('location: ../../index.php');
        exit;
    }
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $farm = [
            "id" => $row['farmId'],
            "name" => $row['farmName'],
            "description" => $row['farmDescription'],
            "updateDate" => $row['farmUpdateDate'],
            "cadastreDate" => $row['farmCadastreDate'],
            "image" => $row['imagePath']
        ];
    }

    $id = $farm['id'];
    $name = $farm['name'];
    $description = $farm['description'];
    $updateDate = $farm['updateDate'];
    $cadastreDate = $farm['cadastreDate'];
    $image = $farm['image'];

    mysqli_close($conn);

    $header =
        "<header>
        <a href='../../index.php'> Voltar </a>
        <h1>$name</h1>
        <h1></h1>
      </header>";

    $farmDetail =
        "<div class='farm-item'>
        <img src='$image' alt='Imagem do boi'>
        <p>Descrição: $description</p>
        <div class='buttons'>
          <a class='farm-btn-editar' href='farm_edit.php?$id' >Editar Fazenda</a>
          <form method='post'>
          <input type='submit' name='button1' value='Deletar' class='farm-btn-deletar'/>
          </form>
        </div>
    </div>";

    $main = "<main> <div class='farm-container'>" . $farmDetail . "</div> </main>";

    $farmPage = $header . $main;

    echo
        "<div id='farm'>" . $farmPage . "</div>";
    ?>
</body>

</html>