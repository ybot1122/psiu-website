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
  $count = dbQuery("SELECT COUNT(id) FROM bioContent WHERE team = -1")[0];
  for ($i = 0; $i < $count; $i++) {
    genBio(true, $i);
  }
  displayFooter();
?>