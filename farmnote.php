<?php
$pagename = "bull";

?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(function () {
            $("#bull").show();
            $("#pasture").hide();
            $("#farm").hide();
        });
    </script>
    <title>FarmNote</title>
</head>

<body>

    <div id="farmnote">

        <div id="bull"></div>
        <div id="pasture"></div>
        <div id="farm"></div>

        <!-- bottomNavBar -->
        <div class="bottomNavBar" id="bottomNavBar">
            <a id="bullButton">Boi</a>
            <a id="pastureButton">Pasto</a>
            <a id="farmButton">Fazenda</a>
        </div>

    </div>


</body>

</html>

<script>
    $(document).ready(function () {
        $("#bullButton").click(function () {
            $("#bull").show();
            $("#pasture").hide();
            $("#farm").hide();
        });
        $("#pastureButton").click(function () {
            $("#bull").hide();
            $("#pasture").show();
            $("#farm").hide();
        });
        $("#farmButton").click(function () {
            $("#bull").hide();
            $("#pasture").hide();
            $("#farm").show();
        });
    });

    $(function () {
        $("#bull").load('bull/bull.php');
        $("#pasture").load('pasture/pasture.php');
        $("#farm").load('farm/farm.php');
    });
</script>