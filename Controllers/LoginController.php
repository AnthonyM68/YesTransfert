<?php
require_once('Models/admin.php');

//Initialise la session

$_SESSION['login']    = "";
$_SESSION['password'] = "";
$displayDiv           = '';
$divResponseError     = '<div class="alert-danger response-error form-control">';
$divResponseValid     = '<div class="alert-success response-valid form-control">';
$closeDiv             = '</div>';
// si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Check si champs "login" non vide
   

   if (!empty($_POST["login"]) && !empty($_POST["password"]) || !empty($_POST["email"]) && !empty($_POST["password"])) {

      $data = checkLogin($pdo);
      if ($data !== false) {
         session_start();
         $_SESSION['login'] = $data['login'];
         $_SESSION['password'] = $data['password'];
         header('Location: Admin');
         exit();
      }
   }  
   else if (!empty($_POST["login"]) && empty($_POST["password"]) || !empty($_POST["email"]) && empty($_POST["password"])){
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
