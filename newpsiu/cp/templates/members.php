<?PHP
	// cp/templates/members.php - functions to generate the forms for editing team bios

	/*
		generates a form either for editing/removing current team members
		or for adding a new member
			$add 	=>	boolean: true for creating an 'add' form. false for creating
						an 'edit/remove' form
			$data 	=> 	associative array of associative arrays. if $add is set to true
						this argument will be ignored. otherwise each inner associative
						array should have
							"id": the unique id of this member
							"team": id of the team of this member is on
							"exec": identify if this member is on exec council
							"header": content to be wrapped in <h2>
							"content": content to be wrapped in a <div>
							"info": properly formatted string to be rendered into a <table>
	*/

	function memberFormRender($add, $data) {
		if ($add === true) {
			$data = [[
				"id" => "default",
				"team" => -1,
				"exec" => 0,
				"header" => "Member Name",
				"content" => "Summary/Bio",
				"info" => "--::--::--::--::--"
			]];
		} ?>
        <fieldset> <?PHP
		$fields = ["nickname", "hometown", "major", "phone", "email"];
        foreach($data as $content) { 
        	$pref = ($add === true) ? "" : $content["id"]."-"; ?>
			<input name="<?= $pref; ?>header" type="text" class="team-header"
			value="<?= $content["header"]; ?>" />
			<div class="row">
				<div class="col-md-3">
					<img class="img-responsive img-rounded" 
							src="layout/bio/<?= $content["id"]; ?>.png" 
							alt="<?= $content["header"]; ?>" />
					<input name="<?= $pref; ?>img" class="team-upload" type="file">
					<div class="infobox">
						<span class="small">
							<ul>
								<li>1.3 mb limit</li>
								<li>.png format only</li>
								<li>exactly 300px wide, 200px tall</li>
								<li>USE COMMON SENSE</li>
							</ul>
						</span>
					</div>
				</div>
				<div class="col-md-9">
					<table>
						<tr> <?PHP
						foreach($fields as $f) { ?>
							<th><?= ucfirst($f); ?></th> <?PHP
						} ?>
						</tr>
						<tr> <?PHP
						$info = explode("::", $content["info"]);
						for($j = 0; $j < 5; $j++) { 
							if ($j >= count($info) || empty($info[$j])) { ?>
								<td>
									<input name="<?= $pref.$fields[$j]; ?>"
											class="team-info" type="text" 
											value="<?= $fields[$j] ?>" />
								</td> <?PHP
							} else { ?> 
								<td>
									<input name="<?= $pref.$fields[$j]; ?>" 
											class="team-info" type="text"
											value="<?= $info[$j]; ?>" />
								</td> <?PHP
							}
						} ?>
						</tr>
					</table>
					<textarea name="<?= $pref; ?>content" 
							class="team-bio"><?= $content["content"]; ?></textarea>
					<?= buildRadios($pref, $content); ?>
					<div class="delbox">
						<span class="small">
							If this box is checked, this profile will be removed upon submit<br />
						</span>
						<input name="<?= $pref; ?>del" type="checkbox" />
					</div>
				</div>
			</div> <?PHP       	
		} ?>
        </fieldset> <?PHP
	}

	/*
		generates html for members with a tabbed view (for editing/removing existing members).
			$data 	=> 	3-dimensional array where the outermost contains each team and 
						each team's array contains arrays for the specific member's data.
							outermost array contains the keys "Ec", "Rush", "Social", "Philanthropy"
							2nd level array contains each info about each member
							3rd level array contains the same keys as specified above
	*/

	function tabbedMemberFormRender($data) { ?>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#exec" data-toggle="tab">Exec</a></li>
			<li><a href="#rush" data-toggle="tab">Rush</a></li>
			<li><a href="#social" data-toggle="tab">Social</a></li>
			<li><a href="#philanthropy" data-toggle="tab">Philanthropy</a></li>
		</ul> 
		<div class="tab-content">
			<div class="tab-pane active" id="exec"> <?PHP
				memberFormRender(false, $data["Ec"]); ?>
			</div>
			<div class="tab-pane" id="rush"> <?PHP
				memberFormRender(false, $data["Rush"]); ?>
			</div>
			<div class="tab-pane" id="social"> <?PHP
				memberFormRender(false, $data["Social"]); ?>
			</div>
			<div class="tab-pane" id="philanthropy"> <?PHP
				memberFormRender(false, $data["Philanthropy"]); ?>
			</div>
		</div> <?PHP
	}

	/*
		private helper function for building the member editing form. responsible for
		creating the radio buttons and checkbox indicating team and ec position
	*/

	function buildRadios($pref, $content) {
		$teams = ["None", "Rush", "Social", "Philanthropy"];
		$i = -1;
		while ($i < 3) { ?>
			<input type="radio" name="<?= $pref; ?>team" value="<?= $i; ?>" <?PHP
			if ($i == $content["team"]) { ?>
				checked <?PHP
			} ?>
			> <?= $teams[$i + 1]; ?> <?PHP
			$i++;
		} ?>
		<input type="checkbox" name="<?= $pref; ?>ec" <?PHP 
			if ($content["exec"] == 1) { ?>
				checked <?PHP
			} ?>
		>EC Member? <?PHP
	}
?>