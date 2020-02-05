<?php
require_once('Models/admin.php');

$_SESSION['login']    = "";
$_SESSION['password'] = "";
$displayDiv           = '';
$divResponseError     = '<div class="alert-danger response-error form-control">';
$divResponseValid     = '<div class="alert-success response-valid form-control">';
$closeDiv             = '</div>';


// si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!empty($_POST["login"]) && !empty($_POST["password"])){

      $checkLogin = checkLogin($pdo);
      if ($checkLogin !== false) {
         session_start();
         $_SESSION['login'] = $checkLogin['login'];
         $_SESSION['password'] = $checkLogin['password'];
         header('Location: Admin');
         exit();
      } 
   } else if (!empty($_POST["email"]) && !empty($_POST["password"])){

      $checkEmail = checkEmail($_POST["email"], $pdo);
      if ($checkEmail !== false) {
         session_start();
         $_SESSION['email'] = $checkEmail['email'];
         $_SESSION['password'] = $checkEmail['password'];
         header('Location: Admin');
         exit();
      }
   } else {
      $displayDiv = $divResponseError . "Vous n'êtes pas inscrit au service" . $closeDiv;

   }
   if (!empty($_POST["login"]) && empty($_POST["password"]) || !empty($_POST["email"]) && empty($_POST["password"])){
      $displayDiv = $divResponseError . "Mot de passe vide" . $closeDiv;
   } 
   else if (empty($_POST["login"]) && !empty($_POST["password"]) || empty($_POST["email"]) && !empty($_POST["password"])){
      $displayDiv = $divResponseError . "Identifiant ou Email vide" . $closeDiv;
   } 
   else if (( empty($_POST["login"]) && empty($_POST["password"])) && (empty($_POST["email"]) && empty($_POST["password"]))) {
      $displayDiv = $divResponseError . "Aucun champ remplis: erreur" . $closeDiv;
   } 
}

require_once('Views/loginView.php');
