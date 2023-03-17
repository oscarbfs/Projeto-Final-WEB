<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="farm/styles/farmstyle.css">
  <title>Fazendas</title>
</head>

<body>
  <?php
  include("../farmServices/sql.php");
  // $_SESSION['currentFarmId'] = $_GET['farmId'];

  //select database
  $db = mysqli_select_db($conn, $DBName);

  $result = mysqli_query($conn, $farmsData);
  $farms = [];

  if (mysqli_num_rows($result) > 0) {

    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $farms[] = [
        "id" => $row['farmId'],
        "name" => $row['farmName'],
        "description" => $row['farmDescription'],
        "updateDate" => $row['farmUpdateDate'],
        "cadastreDate" => $row['farmCadastreDate'],
        "image" => $row['imagePath'],
      ];
    }

  } else {
    echo "0 results";
  }
  mysqli_close($conn);

  $header =
    "<header>
        <h1>Fazendas</h1>
        <a href='farm/pages/farm_create.php' class='farm-btn-cadastrar'>Cadastrar Fazenda</a>
    </header>";

  $farmList = "";

  foreach ($farms as $key => $value) {
    $id = $value["id"];
    $name = $value["name"];
    $description = $value["description"];
    $updateDate = $value["updateDate"];
    $cadastreDate = $value["cadastreDate"];
    $image = $value["image"];
    
    $textButton = 'Selecionar Fazenda';
    $selecionadoOuNao = 'selecionar';

    if ($currentFarmId == $id) {
      $selecionadoOuNao = 'selecionada';
      $textButton = 'Fazenda Selecionada';
    }
    
    $farmList .=
    "<div class='farm-fazenda'>
        <img src='$image' alt='Imagem da Fazenda'>
        <div class='farm-fazenda-info'>
            <h2><a href='farm/pages/farm_details.php?$id'>$name</a></h2>
            <p>$description</p>
        </div>
        <button class='farm-$selecionadoOuNao'>$textButton</button>
    </div>";
  }

  $main = "<main>" . $farmList . "</div> </main>";

  echo
    "<div id='farm'>" . $header . $main . "</div>";
  ?>
</body>

</html>