<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="farm/farmstyle.css">
  <title>Fazendas</title>
</head>

<body>
  <?php
  include("../../mysqli/connection.php");
  // $_SESSION['currentFarmId'] = $_GET['farmId'];

  //select database
  $db = mysqli_select_db($conn, $DBName);

  // sql to insert data
  $sql = "SELECT * FROM farm";

  $result = mysqli_query($conn, $sql);
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
      ];
    }

  } else {
    echo "0 results";
  }
  mysqli_close($conn);

  $header =
    "<header>
        <h1>Fazendas</h1>
        <a href='farm/pages/farm_create.php' class='btn-cadastrar'>Cadastrar Fazenda</a>
    </header>";

  $farmList = "";

  foreach ($farms as $key => $value) {
    $id = $value["id"];
    $name = $value["name"];
    $description = $value["description"];
    $updateDate = $value["updateDate"];
    $cadastreDate = $value["cadastreDate"];
    
    $textButton = 'Selecionar Fazenda';
    $selecionadoOuNao = 'selecionar';

    if ($currentFarmId == $id) {
      $selecionadoOuNao = 'selecionado';
      $textButton = 'Fazenda Selecionada';
    }
    
    

    $farmList .=
    "<div class='fazenda'>
        <img src='https://img.freepik.com/fotos-gratis/cenario-de-produtos-naturais-fazenda-e-luz-solar_53876-143219.jpg' alt='Imagem da Fazenda'>
        <div class='fazenda-info'>
            <h2>$name</h2>
            <p>$description</p>
        </div>
        <button id='select-fazenda-$id' class='selecionar'>Selecionar Fazenda</button>
    </div>";
  }

  $main = "<main>" . $farmList . "</div> </main>";

  echo
    "<div id='farm'>" . $header . $main . "</div>";
  ?>
</body>

</html>

<script>
    // Adiciona um evento de clique para cada botão de mudança de fazenda
    var btnMudarFazenda = document.querySelectorAll('.selecionar');
    for (var i = 0; i < btnMudarFazenda.length; i++) {
        btnMudarFazenda[i].addEventListener('click', function () {

            // Marca o botão clicado como selecionado
            this.classList.add('selecionado');

            // Desmarca todos os outros botões como não selecionados
            for (var j = 0; j < btnMudarFazenda.length; j++) {
                if (btnMudarFazenda[j] !== this) {
                    btnMudarFazenda[j].classList.remove('selecionado');
                }
            }

            // Envia uma requisição AJAX para atualizar a fazenda selecionada no PHP
            var fazendaId = this.id.replace('select-fazenda-', '');
            var xhttp = new XMLHttpRequest();
            xhttp.open('GET', 'atualizar_fazenda.php?fazenda_id=' + fazendaId, true);
            xhttp.send();
        });
    }

</script>