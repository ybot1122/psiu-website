<?PHP
	// cp/templates/gallery.php - functions to generate the forms for editing team bios

	/*
		retrieves all active events from database
		parses and produces form html for each
	*/

	function activeEventFormRender($content) {
		foreach($content as $panel) {
			$id = $panel["id"]; ?>
			<div>
				<input type="text" class="team-header" 
					name="<?= $id; ?>-title" value="<?= $panel["title"]; ?>" />
				<textarea name="<?= $id; ?>-desc" class="team-header"><?= $panel["description"]; ?></textarea>
				<p>Date: <?= $panel["date"]; ?></p>
				<div class="delbox">
					<span class="small">
						If this box is checked, this event will be marked for deletion<br />
					</span>
					<input name="<?= $panel["id"]; ?>-del" type="checkbox" />
				</div>
			</div> <?PHP
		}
	}
?>