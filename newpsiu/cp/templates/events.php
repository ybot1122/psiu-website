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
			<div>
				<input type="text" class="team-header" 
					name="<?= $id; ?>-title" value="<?= $panel["title"]; ?>" />
				<textarea name="<?= $id; ?>-desc" class="team-header"><?= $panel["description"]; ?></textarea>
				<select name="<?= $id; ?>-month"> <?PHP
					for ($i = 1; $i <= 12; $i++) {
						if ($i == $date["month"]) { ?>
							<option value="<?= $i; ?>" selected><?= $i; ?></option> <?PHP
						} else { ?>
							<option value="<?= $i; ?>"><?= $i; ?></option> <?PHP
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
				<select name="month">
					<option value="1">Jan</option>
					<option value="2">Feb</option>
					<option value="3">Mar</option>
					<option value="4">Apr</option>
					<option value="5">May</option>
					<option value="6">Jun</option>
					<option value="7">Jul</option>
					<option value="8">Aug</option>
					<option value="9">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
				</select>
				<select name="day">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
				<?= date("Y"); ?>
				<input type="submit" value="Add This Event" />
			</div>
		</form> <?PHP
	}
?>