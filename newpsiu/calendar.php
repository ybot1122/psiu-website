<?PHP
	include("lib/boilerplate.php");
	include("lib/templates/events.php");
	$static = getStaticContent(["Calendar"]);
	$data = getEvents();
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
		<div id="carousel-events" class="carousel slide" data-ride="carousel" data-interval="">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?= createSelectors(count($data)); ?>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?= renderEvents($data); ?>
			</div>
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-events" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-events" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
</div>
<?PHP
	displayFooter();
?>