<?PHP
  include("lib/boilerplate.php");
  include("lib/faq_func.php");
  displayHeader("Photos");
  displayTopNav();
?>
<div class="row narrow">
  <div class="col-md-12 btn-group-lg">
    <h3>Frequently Asked Questions</h3>
    <?= makeFAQ(); ?>
  </div>
</div>
<?PHP
  displayFooter();
?>