<?php
require_once('Models/register.php');
$displayDiv  = '';
$divResponseError = '<div class="alert-danger response-error form-control">';
$divResponseValid = '<div class="alert-success response-valid form-control">';
$closeDiv         = '</div>';
//Initialise la session
/*
session_start();
$_SESSION['login'] = "";
$_SESSION['password'] = "";*/

// si le formulaire est envoyé
if (isset($_POST['registerForm'])) {
   // Check si champs "login" non vide

   if (!empty('login') && !empty($_POST['password'])) {

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
         /*
         header('Location: Admin');
         exit();*/
      }
      //register($userlogin, $userpass, $pdo);
   } else {;
   }
}

require_once('Views/registerView.php');
