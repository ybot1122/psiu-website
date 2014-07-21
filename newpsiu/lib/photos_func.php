<?PHP

# Creates carousel selectors of every image in gallery folder 
function createSelectors() {
	$num = count(glob('./layout/gallery/*.jpg'));
	for ($i = 0; $i < $num; $i++) {
		if ($i == 0) {
?>
	<li data-target="#carousel-photos" data-slide-to="0" class="active"></li>
<?PHP
		} else {
?>
	<li data-target="#carousel-photos" data-slide-to="<?= $i ?>"></li>
<?PHP
		}
	}
}

# Creates a carousel item for every image in the gallery folder
function createItems() {
	$counter = 1;
	foreach (glob('./layout/gallery/*.jpg') as $filename) {
		if ($counter == 1) {
?>
	<div class="item active">
<?PHP
		} else {
?>
    <div class="item">
<?PHP
		}
?>
        <img src="<?= $filename ?>" alt="<?= $filename ?>" style="height: 500px; margin-left: auto; margin-right: auto;">
        <div class="carousel-caption custom-caption">
            <h3>Photo <?= $counter ?></h3>
            <p>Descriptions Soon</p>
        </div>
    </div>
<?PHP
		$counter++;
	}
}
?>