<?PHP
	function renderEvents($data) {
		for ($i = 0; $i < count($data); $i++) {
			if ($i == 0) { ?>
				<div class="item active"> <?PHP
			} else { ?>
				<div class="item"> <?PHP
			} ?>
				<h3><?= $data[$i]["title"]; ?></h3>
				<p>
					<?= $data[$i]["description"]; ?>
					<span><?= $data[$i]["date"]; ?></span>
				</p>
			</div> <?PHP
		}
	}

	function createSelectors($num) { ?>
		<li class="active" data-target="#carousel-events" data-slide-to="0"></li> <?PHP
		for ($i = 1; $i <= $num; $i++) { ?>
			<li data-target="#carousel-events" data-slide-to="<?= $i ?>"></li> <?PHP
		}
	}
?>