<?php
include("../../mysqli/connection.php");

function bullWithId($id)
{
    return "SELECT 
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
        imagem.imageId as imageId,
        pasture.pastureName as pastureName,
        farm.farmName as farmName
        FROM 
        bull
        INNER JOIN imagem on (imagem.imageObjectId = bull.bullId AND imageObjectOfImage='bull')
        INNER JOIN pasture on (pasture.pastureId = bull.bullPastureId)
        INNER JOIN farm on (farm.farmId = bull.bullFarmId)
        WHERE bullId=$id";
}
;

function deleteBullWithId($id)
{
    return "DELETE 
          FROM 
          bull
          WHERE bullId=$id";
}
;

?>