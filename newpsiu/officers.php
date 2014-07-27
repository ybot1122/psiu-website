<?PHP
  include("lib/boilerplate.php");
  displayHeader("Officers");
  displayTopNav();
?>
<div class="row">
  <div class="col-md-12">
    <?= genStandardContent("Officers", 0, false); ?>
  </div>
</div>
<?PHP
  for ($i = 0; $i <= 1; $i++) {
    genBio(true, $i);
  }
  displayFooter();
?>