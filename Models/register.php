<?php

// Connexion BDD -> PDO
require_once('config.php');

$options = [
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, $options);


function checkEmail($useremail, $pdo)
{
   $req = $pdo->prepare('SELECT `email` FROM login_admin WHERE `email` = :email');
   $req->bindValue(':email', $useremail, PDO::PARAM_STR);
   $req->execute();
   $data = $req->fetch();
   return $data;
}
function register($userlogin, $userpass, $useremail, $pdo)
{
   $req = $pdo->prepare("INSERT INTO login_admin (login, password, email)
   VALUES (:login, :password, :email)");

   $req->bindValue(':login', $userlogin, PDO::PARAM_STR);
   $req->bindValue(':password', $userpass, PDO::PARAM_STR);
   $req->bindValue(':email', $useremail, PDO::PARAM_STR);

   $data = $req->execute();
   return $data;

}