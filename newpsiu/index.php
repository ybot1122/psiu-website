<?PHP
	// function to generate regular content
	include("lib/boilerplate.php");
	include("lib/templates/events.php");
	$data = getStaticContent(["Home"]);
	$events = getEvents();
	displayHeader("Home");
	displayTopNav();
?>
<div class="row narrow">
	<div class="col-md-12">
		<?= staticContentRender($data[0], false); ?>
	</div>
</div>
<div class="row narrow">
	<div class="col-md-6">
		<?= staticContentRender($data[1], false); ?>
	</div>
	<div class="col-md-6">
		<!-- row 1, events -->
		<div class="row narrow">
			<div class="col-md-12">
				<h2>Upcoming Events</h2>
				<div class="btn-group-lg events">
					<?= eventDropdown($events); ?>
				</div>
			</div>
		</div>
		<!-- row 2, house -->
		<div class="row narrow">
			<div class="col-md-12">
				<?= staticContentRender($data[2], false); ?>
			</div>
		</div>
	</div>
</div>
<?PHP
	displayFooter();
?>