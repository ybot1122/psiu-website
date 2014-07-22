<?PHP 
  include("lib/boilerplate.php");
  displayHeader("Values");
  displayTopNav();
?>
<div class="row narrow">
  <!-- left col (content) -->
  <div class="col-md-6">
    <!-- row 1 -->
    <div class="row narrow">
      <div class="col-md-12">
      <?= displayContent("About", 1); ?>
      </div>
    </div>
    <!-- row 2 -->
    <div class="row narrow">
      <div class="col-md-12">
        <?= displayContent("About", 2); ?>
      </div>
    </div>
    <!-- row 3 -->
    <div class="row narrow">
      <div class="col-md-12">
      <?= displayContent("About", 3); ?>
      </div>
    </div>
</div>
  <!-- right col (picture collage) -->
  <div class="col-md-6">
    <div class="row narrow collage">
      <div class="col-md-12"></div>
    </div>
  </div>
</div>
<?PHP
  displayFooter();
?>