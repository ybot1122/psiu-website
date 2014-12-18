<?PHP
	function renderEvents($data) {
		for ($i = 0; $i < count($data); $i++) {
			if ($i == 0) { ?>
				<div class="item active"> <?PHP
			} else { ?>
				<div class="item"> <?PHP
			} ?>
				<div style="width: 300px; border: 1px black solid; margin-left: auto; margin-right: auto;">
				<h3><?= $data[$i]["title"]; ?></h3>
				<p>
					<?= $data[$i]["description"]; ?>
					<span><?= $data[$i]["date"]; ?></span>
				</p>
				</div>
			</div> <?PHP
		}
	}

	function createSelectors($num) {
		for ($i = 0; $i < $num; $i++) { 
			if ($i == 0) { ?>
				<li data-target="#carousel-events" data-slide-to="<?= $i ?>" class="active"></li> <?PHP
			} else { ?>
				<li data-target="#carousel-events" data-slide-to="<?= $i ?>"></li> <?PHP
			}
		}
	}
?>