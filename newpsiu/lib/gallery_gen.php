<?PHP
	/*
		gallery_gen.php; some helper functions to produce the carousel elements
	*/

	function createSelectors() {
		$num = dbQuery("SELECT COUNT(id) FROM galleryContent")[0]; ?>
		<li data-target="#carousel-photos" data-slide-to="0"></li> <?PHP
		for ($i = 1; $i <= $num; $i++) { ?>
			<li data-target="#carousel-photos" data-slide-to="<?= $i ?>"></li> <?PHP
		}
	}

	function createItems() {
		$ids = dbQuery("SELECT id, content, header FROM galleryContent", [], true); ?>
		<div class="item active">
			<img src="layout/gallery/default.png" alt="<?= $ids[$i]["header"] ?>" 
				style="height: 500px; margin-left: auto; margin-right: auto;">
			<div class="carousel-caption custom-caption">
				<h3>Chapter House</h3>
				<p>View of the house from 47th street.</p>
			</div> 
		</div> <?PHP
		for ($i = 0; $i < count($ids); $i++) { ?>
			<div class="item">
				<img src="layout/gallery/<?= $ids[$i]["id"] ?>.png" alt="<?= $ids[$i]["header"] ?>" 
					style="height: 500px; margin-left: auto; margin-right: auto;">
				<div class="carousel-caption custom-caption">
					<h3><?= $ids[$i]["header"]; ?></h3>
					<p><?= $ids[$i]["content"]; ?></p>
				</div> 
			</div> <?PHP
		}
	}
?>