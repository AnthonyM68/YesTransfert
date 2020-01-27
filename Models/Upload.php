<?php

// Connexion BDD -> PDO
require_once('config.php');
$options = [
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, $options);

function insertUpload($tabValue, $pdo)
{
   $req = $pdo->prepare("INSERT INTO client_list (mail_exp, mail_dest, zip, sujet, message)
   VALUES (:mail_exp, :mail_dest, :zip, :sujet, :message)");

   $result = $req->execute($tabValue);
   return $result;
}
