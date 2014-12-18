<?PHP
	function renderEvents($data) {
		for ($i = 0; $i < count($data); $i++) {
			$dateString = date("M j, Y", strtotime($data[$i]["date"]));
			if ($i == 0) { ?>
				<div class="item active"> <?PHP
			} else { ?>
				<div class="item"> <?PHP
			} ?>
				<div>
				<h3><?= $data[$i]["title"]; ?> - <?= $dateString; ?></h3>
				<p>
					<?= $data[$i]["description"]; ?>
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

	function eventDropdown($events) {
		$limit = min(count($events), 5);
		for ($i = 0; $i < $limit; $i++) { 
			$dateString = date("M j, Y", strtotime($events[$i]["date"]));
			?>
			<button type="button" class="btn btn-default btn-event btn-block" 
					data-toggle="collapse" data-target="#event-<?= $i; ?>">
				<?= $dateString; ?>: <?= $events[$i]["title"]; ?>
			</button>
			<div id="event-<?= $i; ?>" class="collapse">
				<?= $events[$i]["description"]; ?>
			</div> <?PHP
		}
	}
?>