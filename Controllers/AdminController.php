<?php
require_once('Models/admin.php');

session_start();
//fonction qui supprime le fichier du serveur
function deleteFile($adressZip){
    //on récupère l'adresse et nom du fichier
    $adressServer ='./' . $adressZip;
    //On le supprime
    unlink($adressServer);
    // Si une erreur est survenu et que le fichier existe toujours
    if(file_exists($adressServer)){
        $result = "Le fichier n'a pas pu être supprimé du serveur";
    } else {
        //sinon on affiche qu'il a bien été supprimé
        $result = "Le fichier a été supprimé du serveur";
    }
    //on retourne le message de réponse
    return $result;
}

require_once('Views/adminView.php');