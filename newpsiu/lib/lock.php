<?PHP
  // INCLUDE THIS FILE ON ANY PAGE THAT IS PROTECTED
  if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    displayHeader("Access Denied");
    displayTopNav();
?>
<div class="row narrow">
  <div class="col-md-12">
      <h3>Access Denied <small>Must be logged in</small></h3>
  </div>
</div>
<?PHP
    displayFooter();
    session_unset();
    session_destroy();
    exit();
  }
?>