<?php require_once "header.php"; ?>

<div class="wrapper row">

   <form method="POST" id="registerForm" class="form-signin">
      <h2 class="form-signin-heading">Inscription Administration</h2>
      <input type="text" name="login" class="form-control" placeholder="Identifiant">
      <input type="password" name="password" class="form-control" placeholder="Mot de passe">
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
      <!--On affiche le résultat du traitement-->
      <?= $displayDiv ?>
      <!--On affiche le résultat du traitement-->
      <input type="submit" class="btn btn-primary form-control">
   </form>
</div>

<?php require_once "footer.php"; ?>