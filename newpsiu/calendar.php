<?PHP
  include("lib/boilerplate.php");
  displayHeader("Calendar");
  displayTopNav();
?>
<div class="row">
  <div class="col-md-12">
    <?= genStandardContent("Calendar", 0, false); ?>
  </div>
</div>
<?PHP
  displayFooter();
?>