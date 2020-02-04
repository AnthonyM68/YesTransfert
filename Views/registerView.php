<?php require_once "header.php"; ?>

<div class="wrapper row">

   <form method="POST" id="registerForm" class="form-signin">
      <h2>Inscription</h2>
      <div class="form-group">
         <label>Identifiant</label>
         <input type="text" name="login" class="form-control">
      </div>

      <div class="form-group">
         <label>Mot de passe</label>
         <input type="password" name="password" class="form-control">

      </div>
      <div class="form-group">
         <label for="email">Email</label>
         <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Votre email">
         <small id="emailHelp" class="form-text text-muted form-control">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre.</small>

      </div>
      <!--On affiche le résultat du traitement-->
      <?=$displayDiv?>
            <!--On affiche le résultat du traitement-->
      <div class="form-group">
         <input type="submit" class="btn btn-primary form-control" name="registerForm">
      </div>
   </form>
</div>

<?php require_once "footer.php"; ?>