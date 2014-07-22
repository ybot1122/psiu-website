<?PHP
  include("lib/boilerplate.php");
  include("lib/calendar_func.php");
  displayHeader("Calendar");
?>
<script>
  // This method detects the current month and sets the active tab 
  window.onload = function() {
    var month = (new Date()).getMonth() + 1;
    document.querySelector(".nav-tabs > li:nth-of-type(" + month + ")").className += "active";
  };   
</script>            
<?PHP    
  displayTopNav();
?>
<div class="row narrow">
  <div class="col-md-12">
    <h3>Calendar for <?= date('Y'); ?></h3>
    <p>This is our tentative event calendar for the current academic quarter at UW. Please note, events details are always subject to change. In order to attend an event, you MUST contact a member on the rush team. Otherwise, we will <em>not</em> be able to let you in due to security issues.</p>
  </div>
<div class="row narrow">
  <div class="col-md-12">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      <li><a href="#1" data-toggle="tab">January</a></li>
      <li><a href="#2" data-toggle="tab">February</a></li>
      <li><a href="#3" data-toggle="tab">March</a></li>
      <li><a href="#4" data-toggle="tab">April</a></li>
      <li><a href="#5" data-toggle="tab">May</a></li>
      <li><a href="#6" data-toggle="tab">June</a></li>
      <li><a href="#7" data-toggle="tab">July</a></li>
      <li><a href="#8" data-toggle="tab">August</a></li>
      <li><a href="#9" data-toggle="tab">September</a></li>
      <li><a href="#10" data-toggle="tab">October</a></li>
      <li><a href="#11" data-toggle="tab">November</a></li>
      <li><a href="#12" data-toggle="tab">December</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <?= drawYear(); ?>
    </div>
  </div>
</div>
<?PHP
  displayFooter();
?>