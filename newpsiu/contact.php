<?PHP
  include("lib/boilerplate.php");
  displayHeader("Contact");
  displayTopNav();
?>
<div class="row narrow">
  <div class="col-md-12">
    <?= genStandardContent("Contact", 0, false); ?>
  </div>
</div>
<?PHP
  genBio(true, 0, "Rush");
  for($i = 0; $i < 5; $i++) {
    genBio(false, $i, "Rush");
  }
  genBio(true, 0, "Social");
  genBio(true, 0, "Philanthropy");
  displayFooter();
?>