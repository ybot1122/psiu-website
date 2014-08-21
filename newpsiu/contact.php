<?PHP
	include("lib/boilerplate.php");
	include("lib/templates/bios.php");
	$static = getStaticContent(["Contact"]);
	$bios = getTeamContent(["Rush", "Social", "Philanthropy"], false);
	displayHeader("Contact");
	displayTopNav();
?>
<div class="row">
	<div class="col-md-12">
		<?= staticContentRender($static[0], false); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h2 class="centered">Rush Team</h2>
		<?= bioTabDisplayRender($bios["Rush"], false); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h2 class="centered">Social Team</h2>
		<?= bioTabDisplayRender($bios["Social"], false); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h2 class="centered">Philanthropy Team</h2>
		<?= bioTabDisplayRender($bios["Philanthropy"], false); ?>
	</div>
</div>
<?PHP
	displayFooter();
?>