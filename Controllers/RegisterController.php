<?php
require_once('Models/register.php');

//Initialise la session
/*
session_start();
$_SESSION['login'] = "";
$_SESSION['password'] = "";*/


//defini les variables et initialise leurs valeurs



// si le formulaire est envoyé
if (isset($_POST['registerForm'])) {
   // Check si champs "login" non vide

   if (!empty('login') && !empty($_POST['password'])) {

      $userlogin = $_POST['login'];
      $userpass = $_POST['password'];
      register($userlogin, $userpass, $pdo);

   } else {;
   }
   /*header('Location: Admin');
   exit();*/
}

require_once('Views/registerView.php');
