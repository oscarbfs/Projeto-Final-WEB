<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bull/styles/bullstyle.css">
  <title>Detalhes de boi</title>
</head>

<body>
  <?php
  include("../../mysqli/connection.php");

  //select database
  $db = mysqli_select_db($conn, $DBName);

  $id = $_SERVER['QUERY_STRING'];

  $result = mysqli_query($conn, bullWithId($id));
  $bull = [];

  if(isset($_POST['button1'])) {
    $result = mysqli_query($conn, deleteBullWithId($id));
    header('location: ../../index.php');
    exit;
  }
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    $bull[] = [
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

  mysqli_close($conn);
  $header =
    "<header>
        <h1>Detalhamento de Boi $id</h1>
      </header>";

  $bullGrid = "";

  foreach ($bull as $key => $value) {
    $id = $value["id"];
    $pastureId = $value["pastureId"];
    $farmId = $value["farmId"];
    $name = $value["name"];
    $description = $value["description"];
    $updateDate = $value["updateDate"];
    $cadastreDate = $value["cadastreDate"];
    $weightKg = $value["weightKg"];
    $weightArroba = $value["weightArroba"];
    $growthRate = $value["growthRate"];
    $image = $value["image"];
    $pastureName = $value["pastureName"];
    $farmName = $value["farmName"];

    $bullGrid .=
      "<div class='bull-grid-item'>
        <img src='$image' alt='Imagem do boi'>
        <div class='bull-card_header'> 
        <h2>$name</h2>
        <h5>$farmName</h5>
        </div>
        <p>Pasto: $pastureName</p>
        <p>Peso(Kg): $weightKg Kg</p>
        <p>Peso(@): $weightArroba @</p>
        <p>Taxa de Crescimento: $growthRate%</p>
        <p>Descrição: $description</p>
        <form method='post'>
        <input type='submit' name='button1'
                value='Deletar'/>
        </form>
      </div>";
  }
  $main = "<main> <div class='bull-grid-container'>" . $bullGrid . "</div> </main>";

  $bullPage = $header . $main;

  echo
  "<div id='bull'>" . $bullPage . "</div>";
  ?>
</body>
</html>

