<?PHP
	include("lib/boilerplate.php");
	$static = getStaticContent(["Faq"]);
	displayHeader("FAQ");
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