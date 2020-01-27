<?php
require_once('Models/admin.php');

//Initialise la session

$_SESSION['login'] = "";
$_SESSION['password'] = "";


//defini les variables et initialise leurs valeurs
$champVide = "";
$erreur = "";


// si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Check si champs "login" non vide
   if (!empty($_POST["login"]) && !empty($_POST["password"])) {
      //appelle la fonction
      $data = checkLogin($pdo);
      if ($data !== false) {
         session_start();
         $_SESSION['login'] = $data['login'];
         $_SESSION['password'] = $data['password'];
         header('Location: Admin');
         exit();
      } else {
         $erreur = "login ou mot de passe incorrect";
      }
   } else {
      $champVide = "Veuillez remplir tous les champs !";
   }
}

require_once('Views/loginView.php');
