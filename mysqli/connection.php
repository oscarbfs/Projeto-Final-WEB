<?php
session_start();

$servername = "localhost:3306";
$username = "root";
$password = "";
$DBName = "farmnote";
$currentFarmId = $_SESSION['currentFarmId'] ?? 1;
// $currentFarmId = $_COOKIE['currentFarmId'] ?? 1;
$currentFarmNoteTab = 'bull';

// Create connection
$conn = new mysqli($servername, $username, $password);

$bullsData = "
        SELECT 
        bullId,
        bullPastureId,
        bullFarmId,
        bullName,
        bullDescription,
        bullUpdateDate,
        bullCadastreDate,
        bullWeightKg,
        bullWeightArroba,
        bullGrowthRate,
        imagem.imagePath as imagePath,
        pasture.pastureName as pastureName,
        farm.farmName as farmName
        FROM 
        bull
        INNER JOIN imagem on (imagem.imageObjectId = bull.bullId AND imageObjectOfImage='bull')
        INNER JOIN pasture on (pasture.pastureId = bull.bullPastureId)
        INNER JOIN farm on (farm.farmId = bull.bullFarmId)
        WHERE
        bullFarmId=$currentFarmId
        ORDER BY bullId
        ";

$lastBullId = "
        SELECT 
        MAX(bullId) as bullId
        FROM 
        bull
        ";

$pasturesData = "
        SELECT 
        pastureId,
        pastureFarmId,
        pastureName,
        pastureDescription,
        pastureStatus,
        pastureUpdateDate,
        pastureCadastreDate,
        imagem.imagePath as imagePath,
        farm.farmName as farmName
        FROM 
        pasture
        INNER JOIN imagem on (imagem.imageObjectId = pasture.pastureId AND imageObjectOfImage='pasture')
        INNER JOIN farm on (farm.farmId = pasture.pastureFarmId)
        WHERE
        pastureFarmId=$currentFarmId
        ORDER BY pastureId
        ";

$lastPastureId = "
        SELECT 
        MAX(pastureId) as pastureId
        FROM 
        pasture
        ";

$farmsData = "
    SELECT 
    farmId,
    farmName,
    farmDescription,
    farmUpdateDate,
    farmCadastreDate,
    imagem.imagePath as imagePath
    FROM 
    farm
    INNER JOIN imagem on (imagem.imageObjectId = farm.farmId AND imageObjectOfImage='farm')
    ORDER BY farmId
    ";

$lastFarmId = "
    SELECT 
    MAX(farmId) as farmId
    FROM 
    farm
    ";
?>