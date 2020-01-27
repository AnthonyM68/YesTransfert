<?php require_once "header.php"; ?>

<div class="wrapper row">

   <form method="post" id="adminForm" class="form-signin">
      <h2>Administrateur</h2>
      <div class="form-group <?php echo (!empty($login_err)) ? 'has-error' : ''; ?>">
         <label>login</label>
         <input type="text" name="login" class="form-control">
      </div>

      <div class="form-group <?php echo (!empty($champVide)) ? 'has-error' : ''; ?>">
         <label>Password</label>
         <input type="password" name="password" class="form-control">
         <span class="help-block"><?php echo $champVide . $erreur; ?></span>
      </div>
      <div class="form-group">
         <input type="submit" class="btn btn-primary form-control" value="Login">
      </div>
   </form>
</div>

<?php require_once "footer.php"; ?>