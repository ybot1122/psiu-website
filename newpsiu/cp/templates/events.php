<?PHP
	// cp/templates/gallery.php - functions to generate the forms for editing team bios

	/*
		retrieves all active events from database
		parses and produces form html for each
	*/

	function activeEventFormRender($content) { ?>
		<form method="POST" action="cp/calUpdate.php?action=update"> <?PHP
		foreach($content as $panel) {
			$date = date_parse($panel["date"]);
			$id = $panel["id"]; ?>
			<div class="row narrow">
				<input type="text" class="team-header" 
					name="<?= $id; ?>-title" value="<?= $panel["title"]; ?>" />
				<textarea name="<?= $id; ?>-desc" class="team-header"><?= $panel["description"]; ?></textarea>
				<select name="<?= $id; ?>-month"> <?PHP
					for ($i = 1; $i <= 12; $i++) {
						$monthString = date('F', mktime(0, 0, 0, $i, 10));
						if ($i == $date["month"]) { ?>
							<option value="<?= $i; ?>" selected><?= $monthString; ?></option> <?PHP
						} else { ?>
							<option value="<?= $i; ?>"><?= $monthString; ?></option> <?PHP
						}
					} ?>
				</select>
				<select name="<?= $id; ?>-day"> <?PHP
					for ($i = 1; $i <= 31; $i++) {
						if ($i == $date["day"]) { ?>
							<option value="<?= $i; ?>" selected><?= $i; ?></option> <?PHP
						} else { ?>
							<option value="<?= $i; ?>"><?= $i; ?></option> <?PHP
						}
					} ?>
				</select> <?= date("Y"); ?>
				<div class="delbox">
					<span class="small">
						If this box is checked, this event will be marked for deletion<br />
					</span>
					<input name="<?= $panel["id"]; ?>-del" type="checkbox" />
				</div>
			</div> <?PHP
		} ?>
			<input type="submit" value="Submit Event Updates" />
		</form> <?PHP
	}

	function addEventFormRender() { ?>
		<form method="POST" action="cp/calUpdate.php?action=add">
			<div>
				<input type="text" class="team-header" name="title" value="Event Title" />
				<textarea name="desc" class="team-header">Event Description</textarea>
				<select name="month"> <?PHP
					for ($i = 1; $i <= 12; $i++) { 
						$monthString = date('F', mktime(0, 0, 0, $i, 10));
						?>
							<option value="<?= $i; ?>"><?= $monthString; ?></option> <?PHP
					} ?>
				</select>
				<select name="day"> <?PHP
					for ($i = 1; $i <= 31; $i++) { ?>
							<option value="<?= $i; ?>"><?= $i; ?></option> <?PHP
					} ?>
				</select>
				<?= date("Y"); ?>
				<input type="submit" value="Add This Event" />
			</div>
		</form> <?PHP
	}
?>