<?php
include("../../mysqli/connection.php");

function farmWithId($id)
{
    return "SELECT 
        farmId,
        farmName,
        farmDescription,
        farmUpdateDate,
        farmCadastreDate,
        imagem.imageId as imageId,
        imagem.imagePath as imagePath
        FROM 
        farm
        INNER JOIN imagem on (imagem.imageObjectId = farm.farmId AND imageObjectOfImage='farm')
        WHERE farmId=$id
        ";
}
;

function deleteFarmWithId($id)
{
    return "DELETE 
          FROM 
          farm
          WHERE farmId=$id";
}
;
?>