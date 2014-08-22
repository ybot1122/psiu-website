<?PHP
	// templates/gallery.php; some helper functions to produce the carousel elements

	/*
		generates html for the carousel selectors
			$num 	=> 	number of selectors to creat
	*/

	function createSelectors($num) { ?>
		<li data-target="#carousel-photos" data-slide-to="0"></li> <?PHP
		for ($i = 1; $i <= $num; $i++) { ?>
			<li data-target="#carousel-photos" data-slide-to="<?= $i ?>"></li> <?PHP
		}
	}

	/*
		generates html for the photo panels in the carousel
			$data 	=> 	array of associative arrays. each member contains:
							"id": the unique id of this member
							"header": the title of the photo
							"content": short description of this photo
	*/

	function createItems($data) { ?>
		<div class="item active">
			<img src="layout/gallery/default.png" alt="<?= $data[$i]["header"] ?>" 
				style="height: 500px; margin-left: auto; margin-right: auto;">
			<div class="carousel-caption custom-caption">
				<h3>Chapter House</h3>
				<p>View of the house from 47th street.</p>
			</div> 
		</div> <?PHP
		for ($i = 0; $i < count($data); $i++) { ?>
			<div class="item">
				<img src="layout/gallery/<?= $data[$i]["id"] ?>.png" alt="<?= $data[$i]["header"] ?>" 
					style="height: 500px; margin-left: auto; margin-right: auto;">
				<div class="carousel-caption custom-caption">
					<h3><?= $data[$i]["header"]; ?></h3>
					<p><?= $data[$i]["content"]; ?></p>
				</div> 
			</div> <?PHP
		}
	}
?>