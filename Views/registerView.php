<?php require_once "header.php"; ?>

<div class="wrapper row">

   <form method="POST" id="registerForm" class="form-signin">
      <h2>Inscription</h2>
      <div class="form-group">
         <label>login</label>
         <input type="text" name="login" class="form-control">
      </div>

      <div class="form-group">
         <label>Password</label>
         <input type="password" name="password" class="form-control">
         <span class="help-block"></span>
      </div>
      <div class="form-group">
         <input type="submit" class="btn btn-primary form-control" name="registerForm">
      </div>
   </form>
</div>

<?php require_once "footer.php"; ?>