<?PHP 
  include("lib/boilerplate.php");
  include("lib/calendar_func.php");
  displayHeader("Home");
  displayTopNav();
?>
<div class="row narrow">
  <div class="col-md-12">
    <?= displayContent("Home", 1); ?>
  </div>
</div>
<div class="row narrow">
  <div class="col-md-6">
    <?= displayContent("Home", 2); ?>
  </div>
  <div class="col-md-6">
    <!-- row 1, events -->
    <div class="row narrow">
      <div class="col-md-12">
        <h3>Upcoming Events</h3>
        <div class="btn-group-lg events">
          <?= eventButtons(); ?>
        </div>
      </div>
    </div>
    <!-- row 2, house -->
    <div class="row narrow">
      <div class="col-md-12">
        <?= displayContent("Home", 3); ?>
      </div>
    </div>
  </div>
</div>
<?PHP
  displayFooter();
?>