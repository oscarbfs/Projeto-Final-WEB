<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="pasture/styles/pasturestyle.css">
  <title>Pastoss</title>
</head>

<body>
  <?php
  include("../../mysqli/connection.php");

  //select database
  $db = mysqli_select_db($conn, $DBName);

  if ($currentFarmId != -1) {
    // sql to insert data
    // $sql = "SELECT * FROM pasture WHERE pastureFarmId='$currentFarmId'";
  
    $result = mysqli_query($conn, $pasturesData);
    $pastures = [];

    if (mysqli_num_rows($result) > 0) {

      // output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
        $pastures[] = [
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

    }

    mysqli_close($conn);

    $header =
      "<header>
        <h1>Pastos</h1>
        <a href='pasture/pages/pasture_create.php' class='btn-cadastrar'>Cadastrar Pastos</a>
      </header>";

    $pastureGrid = "";

    foreach ($pastures as $key => $value) {
      $id = $value['id'];
      $farmId = $value['farmId'];
      $name = $value['name'];
      $description = $value['description'];
      $status = $value['status'];
      $updateDate = $value['updateDate'];
      $cadastreDate = $value['cadastreDate'];
      $image = $value['image'];
      $farmName = $value['farmName'];

      $pastureGrid .=
        "<div class='grid-item'>
        <img src='$image' alt='Imagem do boi'>
        <div class='card_header'> 
          <h2>$name</h2>
          <h5>$farmName</h5>
        </div>
        <p>Status: $status</p>
        <p>Descrição: $description</p>
      </div>";
    }
    $main = "<main> <div class='grid-container'>" . $pastureGrid . "</div> </main>";

    $pasturePage = $header . $main;

    echo
      "<div id='pasture'>" . $pasturePage . "</div>";
  } else {
    echo "
      <div class=noCurrentFarm>  
        <h2> Você ainda não escolheu um fazenda! </h2>
        <h4>Se não você ainda não cadastrou nenhuma fazenda clique na opção 'Fazenda' na parte inferior da tela e depois clique em 'Cadastar Fazenda'.</h4>
        <h4>Caso já tenha fazenda(s) cadastrada(s) clique na opção 'Fazenda' na parte inferior da tela e depois escolha a fazenda que deseja conferir.</h4>
      </div>
    ";
  }
  ?>
</body>

</html>