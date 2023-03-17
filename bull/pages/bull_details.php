<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bull/styles/bulldetailstyle.css">
  <title>Detalhes de boi</title>
</head>

<body>
  <?php
  include("../bullServices/sql.php");

  //select database
  $db = mysqli_select_db($conn, $DBName);


  $id = $_SERVER['QUERY_STRING'];

  $result = mysqli_query($conn, bullWithId($id));
  $bull = [];

  if (isset($_POST['button1'])) {
    mysqli_query($conn, deleteBullWithId($id));
    header('location: ../../index.php');
    exit;
  }
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
      "image" => $row["imagePath"]
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
  $pastureName = $bull["pastureName"];
  $farmName = $bull["farmName"];

  mysqli_close($conn);

  $header =
    "<header>
        <a href='../../index.php'> Voltar </a>
        <h1>$name</h1>
        <h1>$farmName</h1>
      </header>";

  $bullGrid =
    "<div class='bull-item'>
        <img src='$image' alt='Imagem do boi'>
        <p>Pasto: $pastureName</p>
        <p>Peso(Kg): $weightKg Kg</p>
        <p>Peso(@): $weightArroba @</p>
        <p>Taxa de Crescimento: $growthRate%</p>
        <p>Descrição: $description</p>
        <div class='buttons'>
          <a class='bull-btn-editar' href='bull_edit.php?$id' >Editar Boi</a>
          <form method='post'>
          <input type='submit' name='button1' value='Deletar' class='bull-btn-deletar'/>
          </form>
        </div>
    </div>";

  $main = "<main> <div class='bull-container'>" . $bullGrid . "</div> </main>";

  $bullPage = $header . $main;

  echo
    "<div id='bull'>" . $bullPage . "</div>";
  ?>
</body>

</html>