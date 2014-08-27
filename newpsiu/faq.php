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
<div class="row">
	<div class="col-md-12"> <?PHP
	for ($i = 1; $i < count($static); $i++) { ?>
		<button type="button" class="btn btn-responsive btn-faq" data-toggle="collapse"
				data-target="#q<?= $i; ?>">
			<?= $static[$i]["header"]; ?>
		</button>
		<div id="q<?= $i; ?>" class="collapse faq">
			<?= $static[$i]["content"]; ?>
		</div> <?PHP
	} ?>
	</div>
</div>
<?PHP
	displayFooter();
?>