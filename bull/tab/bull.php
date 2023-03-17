<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bull/styles/bullstyle.css">
  <title>Bois</title>
</head>

<body>
  <?php
  include("../../mysqli/connection.php");

  //select database
  $db = mysqli_select_db($conn, $DBName);

  if ($currentFarmId != -1) {
    // sql to insert data
    // $sql = "SELECT * FROM bull WHERE bullFarmId='$currentFarmId'";
  
    $result = mysqli_query($conn, $bullsData);
    $bulls = [];

    if (mysqli_num_rows($result) > 0) {

      // output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
        $bulls[] = [
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

    }

    mysqli_close($conn);

    $header =
      "<header>
        <h1>Bois</h1>
        <a href='bull/pages/bull_create.php' class='bull-btn-cadastrar'>Cadastrar Boi</a>
      </header>";

    $bullGrid = "";

    foreach ($bulls as $key => $value) {
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
          <h2><a href='bull/pages/bull_details.php?$id'>$name</a></h2>
          <h5>$farmName</h5>
        </div>
        <p>Pasto: $pastureName</p>
        <p>Peso(Kg): $weightKg Kg</p>
        <p>Peso(@): $weightArroba @</p>
        <p>Taxa de Crescimento: $growthRate%</p>
        <p>Descrição: $description</p>
      </div>";
    }
    $main = "<main> <div class='bull-grid-container'>" . $bullGrid . "</div> </main>";

    $bullPage = $header . $main;

    echo
      "<div id='bull'>" . $bullPage . "</div>";
  } else {
    echo "
      <div class=nbull-oCurrentFarm>  
        <h2> Você ainda não escolheu um fazenda! </h2>
        <h4>Se não você ainda não cadastrou nenhuma fazenda clique na opção 'Fazenda' na parte inferior da tela e depois clique em 'Cadastar Fazenda'.</h4>
        <h4>Caso já tenha fazenda(s) cadastrada(s) clique na opção 'Fazenda' na parte inferior da tela e depois escolha a fazenda que deseja conferir.</h4>
      </div>
    ";
  }
  ?>
</body>

</html>