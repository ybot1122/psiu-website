<?PHP
	include("lib/boilerplate.php");
	include("lib/contact_gen.php");
	$static = getStaticContent(["Contact"]);
	displayHeader("Contact");
	displayTopNav();
?>
<div class="row narrow">
	<div class="col-md-12">
		<?= staticContentRender($static[0], false); ?>
	</div>
</div>
<?PHP
	$counts = dbQuery("SELECT COUNT(id) as count FROM bioContent
							GROUP BY team ORDER BY team ASC", [], true); 
?>
<div class="row">
	<h2>Rush Team</h2> <?PHP
	genBio(true, 0, "Rush");
	for($i = 0; $i < $counts[1]["count"] - 1; $i++) {
		genBio(false, $i, "Rush");
	} ?> 
</div>
<div class="row">
	<h2>Social Team</h2> <?PHP
	genBio(true, 0, "Social");
	for($i = 0; $i < $counts[2]["count"] - 1; $i++) {
		genBio(false, $i, "Social");
	} ?> 
</div>
<div class="row">
	<h2>Philanthropy Team</h2> <?PHP
	genBio(true, 0, "Philanthropy");
	for($i = 0; $i < $counts[3]["count"] - 1; $i++) {
		genBio(false, $i, "Philanthropy");
	} ?>
</div> 
<?PHP
	displayFooter();
?>