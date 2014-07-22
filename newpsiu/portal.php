<?PHP 
  include("lib/boilerplate.php");
  include("lib/portal_func.php");
  displayHeader("Admin");
  displayTopNav();
?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <p><?= $message; ?></p>
    <form role="form" method="post" action="portal.php">
      <div class="form-group">
        <label for="InputUser">Username</label>
        <input type="text" name="user" class="form-control" id="InputUser" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="InputPass">Password</label>
        <input name="pass" type="password" class="form-control" id="InputPass" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-default login">Login</button>
    </form>                    
  </div>
</div>
<?PHP
displayFooter();
?>
