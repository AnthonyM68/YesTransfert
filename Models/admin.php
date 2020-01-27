<?php

require_once('config.php');


// Connexion BDD -> PDO
require_once('config.php');
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass, $options);



function checkLogin($pdo)
{
   $req = $pdo->prepare('SELECT `login`, `password` FROM login_admin WHERE `login` = :login AND `password` = :password');

   $req->bindValue(':login', $_POST["login"], PDO::PARAM_STR);
   $req->bindValue(':password', $_POST['password'], PDO::PARAM_STR);

   $req->execute();

   $data = $req->fetch();

   return $data;
}
