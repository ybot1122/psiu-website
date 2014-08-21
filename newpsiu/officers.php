<?PHP
	include("lib/boilerplate.php");
	include("lib/templates/bios.php");
	$static = getStaticContent(["Officers"]);
	$bios = getTeamContent(["Ec"], true);
	displayHeader("Officers");
	displayTopNav();
?>
<div class="row">
	<div class="col-md-12">
		<?= staticContentRender($static[0], false); ?>
	</div>
</div>
<?PHP
	bioFlatDisplayRender($bios["Ec"], false);
	displayFooter();
?>