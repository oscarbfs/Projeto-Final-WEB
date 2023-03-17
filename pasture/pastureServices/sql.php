<?php
include("../../mysqli/connection.php");

function pastureWithId($id)
{
    return "SELECT
        pastureId,
        pastureFarmId,
        pastureName,
        pastureDescription,
        pastureStatus,
        pastureUpdateDate,
        pastureCadastreDate,
        imagem.imageId as imageId,
        imagem.imagePath as imagePath,
        farm.farmName as farmName
        FROM 
        pasture
        INNER JOIN imagem on (imagem.imageObjectId = pasture.pastureId AND imageObjectOfImage='pasture')
        INNER JOIN farm on (farm.farmId = pasture.pastureFarmId)
        WHERE pastureId=$id";
}
;

function deletePastureWithId($id)
{
    return "DELETE 
          FROM 
          pasture
          WHERE pastureId=$id";
}
;
?>