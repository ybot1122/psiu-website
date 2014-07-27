<?PHP
  include("lib/boilerplate.php");
  displayHeader("FAQ");
  displayTopNav();
?>
<div class="row">
  <div class="col-md-12">
    <?= genStandardContent("Faq", 0, false); ?>
  </div>
</div>
<?PHP
  for($i = 1; $i < 4; $i++) { ?>
<div class="row">
  <div class="col-md-12"> <?PHP
    genStandardContent("Faq", $i, false); ?>
  </div> 
</div> <?PHP
  }
  displayFooter();
?>