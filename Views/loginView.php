<?php require_once "header.php"; ?>

<div class="wrapper row">

   <form method="POST" id="adminForm" class="form-signin">
      <h2 class="form-signin-heading">Administrateur</h2>
      <input type="text" name="login" class="form-control" placeholder="Identifiant">
      <input type="password" name="password" class="form-control" placeholder="Mot de passe">
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">

      <input type="submit" class="btn btn-primary form-control">
      <a class="form-control inscription" href="index.php?page=register">Inscription au service</a>

   </form>
</div>

<?php require_once "footer.php"; ?>