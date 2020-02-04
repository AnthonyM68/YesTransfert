<?php

// Connexion BDD -> PDO
require_once('config.php');

$options = [
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, $options);

function register($userlogin, $userpass, $pdo)
{



   $req = $pdo->prepare("INSERT INTO login_admin (login, password)
   VALUES (:login, :password)");


   $req->bindValue(':login', $userlogin, PDO::PARAM_STR);
   $req->bindValue(':password', $userpass, PDO::PARAM_STR);

   $req->execute();

}