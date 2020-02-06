<?php

// Connexion BDD -> PDO
require_once('config.php');
$options = [
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, $options);

//vérifie que l'administration est bien activé

function if_desactivate($pdo){
   $req = $pdo->prepare('SELECT `desactivate` FROM activate_admin WHERE `desactivate` = :desactivate');
   $req->bindValue(':desactivate', $_POST["login"], PDO::PARAM_STR);
   $req->execute();
   $data = $req->fetch();
   return $data;
}

//vérifie si le password correspond au login saisie pas l'utilisateur
function checkLogin($pdo)
{
   $req = $pdo->prepare('SELECT `login`, `password` FROM login_admin WHERE `login` = :login AND `password` = :password');
   $req->bindValue(':login', $_POST["login"], PDO::PARAM_STR);
   $req->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
   $req->execute();
   $data = $req->fetch();
   return $data;
}
//vérifie si l'email correspond au mot de passe dans la BDD
function checkEmail($pdo)
{
   $req = $pdo->prepare('SELECT `password`, `email` FROM login_admin WHERE `password` = :password AND `email` = :email');
  
   $req->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
   $req->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
   $req->execute();
   $data = $req->fetch();
   return $data;
}
// Récupère la liste des entrées de la BDD
function listData($pdo)
{
   $req = $pdo->prepare('SELECT * FROM client_list');
   $req->execute();
   $data = $req->fetchAll();
   return $data;
}
// récupère l'adresse du zip sur le serveur de la BDD
function siExist($pdo, $id)
{
   $req = $pdo->prepare('SELECT `zip` FROM client_list WHERE `id` = :id ');
   $req->bindValue(':id', $id, PDO::PARAM_STR);
   $req->execute();
   $data = $req->fetchAll();
   return $data;
}
//supprime une entrée de la BDD
function delete($pdo)
{
   $req = $pdo->prepare('DELETE FROM `client_list` WHERE `id` = :id');
   $req->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
   $req->execute();
}
