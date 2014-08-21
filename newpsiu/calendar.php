<?PHP
	include("lib/boilerplate.php");
	$static = getStaticContent(["Calendar"]);
	displayHeader("Calendar");
	displayTopNav();
?>
<div class="row">
	<div class="col-md-12">
		<?= staticContentRender($static[0], false); ?>
	</div>
</div>
<?PHP
	displayFooter();
?>