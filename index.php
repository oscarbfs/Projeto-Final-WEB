<?php
include("mysqli/mysqli.php");
?>

</html>

<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
    $(function () {
      $("#farmnotePage").show();
      $("#aboutPage").hide();
    });
  </script>
  <title>FarmNote</title>
</head>

<body>
  <div class="navbar" id="navBar">
    <a id="farmnoteButton">FarmNote</a>
    <a id="aboutButton">Sobre</a>
  </div>

  <div id="farmnotePage"></div>
  <div id="aboutPage"></div>

</body>

</html>

<script>
  $(document).ready(function () {
    $("#farmnoteButton").click(function () {
      $("#aboutPage").hide();
      $("#farmnotePage").show();
    });
    $("#aboutButton").click(function () {
      $("#farmnotePage").hide();
      $("#aboutPage").show();
    });
  });

  $(function () {
    $("#farmnotePage").load('farmnote.php');
    $("#aboutPage").load('about/about.php');
  });
</script>