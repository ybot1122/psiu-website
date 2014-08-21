<?PHP
	// function to generate regular content
	include("lib/boilerplate.php");
	$data = getStaticContent(["Values"]);
	displayHeader("Values");
	displayTopNav();
?>
<div class="row narrow">
	<!-- left col (content) -->
	<div class="col-md-6">
		<!-- row 1 -->
		<div class="row narrow">
			<div class="col-md-12">
				<?= staticContentRender($data[0], false); ?>
			</div>
		</div>
		<!-- row 2 -->
		<div class="row narrow">
			<div class="col-md-12">
			<?= staticContentRender($data[1], false); ?>
			</div>
		</div>
		<!-- row 3 -->
		<div class="row narrow">
			<div class="col-md-12">
			<?= staticContentRender($data[2], false); ?>
			</div>
		</div>
	</div>
	<!-- right col (picture collage) -->
	<div class="col-md-6">
		<div class="row narrow collage">
			<div class="col-md-12">
			<!-- TODO: implement function to produce random collage of n pictures -->
			</div>
		</div>
	</div>
</div>
<?PHP
displayFooter();
?>
