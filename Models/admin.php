<?php

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

// Récupère la liste des entrées de la BDD
function listData($pdo) {

   $req = $pdo->prepare('SELECT * FROM client_list');
   $req->execute();
   $data = $req->fetchAll();
   return $data;
}

// Suprime une entrée de la BDD

function delete($pdo) {

   $req = $pdo->prepare('DELETE FROM `client_list` WHERE `id` = :id');

   $req->bindValue(':id', $_GET["id"], PDO::PARAM_INT);

   $ok = $req->execute();

   if ($ok === false) {
      throw new Exception("Elément non trouvé dans la BDD");
   }

   return $ok;
}
