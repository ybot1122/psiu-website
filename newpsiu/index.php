<?PHP
  // function to generate regular content
  include("lib/boilerplate.php");
  displayHeader("Home");
  displayTopNav();
?>
<div class="row narrow">
  <div class="col-md-12">
    <?= genStandardContent("Home", 0); ?>
  </div>
</div>
<div class="row narrow">
  <div class="col-md-6">
    <?= genStandardContent("Home", 1); ?>
  </div>
  <div class="col-md-6">
    <!-- row 1, events -->
    <div class="row narrow">
      <div class="col-md-12">
        <h3>Upcoming Events</h3>
        <div class="btn-group-lg events">
        </div>
      </div>
    </div>
    <!-- row 2, house -->
    <div class="row narrow">
      <div class="col-md-12">
        <?= genStandardContent("Home", 2); ?>
      </div>
    </div>
  </div>
</div>
<?PHP
  displayFooter();
?>