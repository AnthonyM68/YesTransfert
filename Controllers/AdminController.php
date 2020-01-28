<?php
require_once('Models/admin.php');

session_start();

function deleteFile($adressZip){
    
    $adressServer ='./' . $adressZip;

    unlink($adressServer);

    if(file_exists($adressServer)){
        $result = "Le fichier n'a pas pu être supprimé du serveur";
    } else {
        $result = "Le fichier a été supprimé du serveur";
    }
    return $result;
}

require_once('Views/adminView.php');