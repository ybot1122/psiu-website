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
  $counts = dbQuery("SELECT COUNT(id) as count FROM bioContent GROUP BY team ORDER BY team ASC", [], true);
  // TODO: best way to convert these into bootstrap tabs? 
  genBio(true, 0, "Rush");
  for($i = 0; $i < $counts[1]["count"] - 1; $i++) {
    genBio(false, $i, "Rush");
  }
  genBio(true, 0, "Social");
  for($i = 0; $i < $counts[2]["count"] - 1; $i++) {
    genBio(false, $i, "Social");
  }
  genBio(true, 0, "Philanthropy");
  for($i = 0; $i < $counts[3]["count"] - 1; $i++) {
    genBio(false, $i, "Philanthropy");
  }
  displayFooter();
?>