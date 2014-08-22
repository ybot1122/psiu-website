<?PHP
	include("lib/boilerplate.php");
	include("lib/templates/gallery.php");
	$static = getStaticContent(["Photos"]);
	$photos = getGalleryContent();
	displayHeader("Photos");
	displayTopNav();
?>
<div class="row">
	<div class="col-md-12">
		<?= staticContentRender($static[0], false); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="carousel-photos" class="carousel slide" data-ride="carousel" data-interval="">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?= createSelectors(count($photos)); ?>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?= createItems($photos); ?>
			</div>
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-photos" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-photos" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
</div>
<?PHP
	displayFooter();
?>