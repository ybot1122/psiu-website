<?PHP
	include("lib/boilerplate.php");
	include("lib/MyCalendar.php");
	$static = getStaticContent(["Calendar"]);
	$calendar = new MyCalendar();
	displayHeader("Calendar"); ?>
	<link rel="stylesheet" href="css/calendar.css"> <?PHP
	displayTopNav();
?>
<div class="row">
	<div class="col-md-12">
		<?= staticContentRender($static[0], false); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?= $calendar->calendarTabsRender(); ?>
		<?= $calendar->calendarCarouselRender(); ?>
	</div>
</div>
<?PHP
	displayFooter();
?>