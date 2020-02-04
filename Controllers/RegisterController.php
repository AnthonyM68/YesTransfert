<?php
require_once('Models/register.php');
$displayDiv  = '';
$divResponseError = '<div class="alert-danger response-error form-control">';
$divResponseValid = '<div class="alert-success response-valid form-control">';
$closeDiv         = '</div>';

// si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
   if ( !empty('login') && !empty($_POST['password']) && !empty($_POST["email"]) ) {

      $userlogin = $_POST['login'];
      $userpass = $_POST['password'];
      $useremail = $_POST['email'];
      $data = checkEmail($useremail, $pdo);
      if ($data) {
         $displayDiv  = $divResponseError . "Vous êtes déjà Administrateur de Yes Transfert" . $closeDiv;
      } else {
         $registry = register($userlogin, $userpass, $useremail, $pdo);
         if ($registry) {
            $displayDiv  = $divResponseValid . "Vous voilà désormais Administrateur de Yes Transfert" . $closeDiv;
            session_start();
            $_SESSION['login'] = $userlogin;
            $_SESSION['password'] = $userpass;
         } else {
            $displayDiv = $divResponseError . "Une erreur est servenue pendant l'enregistrement" . $closeDiv;
         }
      }
   } else if ( !empty($_POST["login"]) && empty($_POST["password"]) || !empty($_POST["email"]) && empty($_POST["password"]) ) {
         $displayDiv = $divResponseError . "Mot de passe vide" . $closeDiv;
   } 
   else if (empty($_POST["login"]) && !empty($_POST["password"]) || empty($_POST["email"]) && !empty($_POST["password"])){
      $displayDiv = $divResponseError . "Identifiant ou Email vide" . $closeDiv;
   } 
   else if (( empty($_POST["login"]) && empty($_POST["password"])) && (empty($_POST["email"]) && empty($_POST["password"]))) {
      $displayDiv = $divResponseError . "Aucun champ remplis: erreur" . $closeDiv;
   
   }
}

require_once('Views/registerView.php');
