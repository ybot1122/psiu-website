<?PHP
	// cp/templates/form.php - functions for the admin panel to generate appropriate
	// form DOM elements

	/*
		generates a form to edit static content
			$data 	=>	array of associative arrays where each inner 
						associative array contains:
							"header": content in the <h2>, title of panel
							"content": the content of the panel
	*/

	function staticContentFormRender($data) { ?>
	    <form method="POST" action="cp/update.php?edit=static&page=<?= $_GET["page"]; ?>"> <?PHP
	    foreach($data as $panel) { ?>
			<fieldset>
			<input name="<?= $panel["id"]; ?>-header" class="static-header"
					type="text" value="<?= $panel["header"]; ?>" />
			<textarea name="<?= $panel["id"]; ?>-content" class="static-content">
				<?= $panel["content"]; ?>
			</textarea>
	      </fieldset> <?PHP
	    } ?>
	      <input type="submit" value="Submit!" />
	    </form> <?PHP
	}

	/*
		generates a form either for editing/removing current team members
		or for adding a new member
			$add 	=>	boolean: true for creating an 'add' form. false for creating
						an 'edit/remove' form
			$data 	=> 	associative array of associative arrays. if $add is set to false
						this argument will be ignored. otherwise each inner associative
						array should have
							"id": the unique id of this member
							"team": id of the team of this member is on
							"exec": identify if this member is on exec council
							"header": content to be wrapped in <h2>
							"content": content to be wrapped in a <div>
							"info": properly formatted string to be rendered into a <table>
	*/

	function memberFormRender($add, $data) { ?>
        <fieldset> <?PHP
		$fields = ["nickname", "hometown", "major", "phone", "email"];
        foreach($data as $content) { ?>
			<input name="<?= $content["id"]; ?>-header" type="text" class="team-header"
			value="<?= $content["header"]; ?>" />
			<div class="row">
				<div class="col-md-3">
					<img class="img-responsive img-rounded" 
							src="layout/bio/<?= $content["id"]; ?>.png" 
							alt="<?= $content["header"]; ?>" />
					<input name="<?= $content["id"]; ?>-img" class="team-upload" type="file">
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
									<input name="<?= $content["id"]."-".$fields[$j]; ?>"
											class="team-info" type="text" 
											value="<?= $fields[$j] ?>" />
								</td> <?PHP
							} else { ?> 
								<td>
									<input name="<?= $content["id"]."-".$fields[$j]; ?>" 
											class="team-info" type="text"
											value="<?= $info[$j]; ?>" />
								</td> <?PHP
							}
						} ?>
						</tr>
					</table>
					<textarea name="<?= $content["id"]; ?>-content" 
							class="team-bio"><?= $content["content"]; ?></textarea>
					<?= buildRadios($content); ?>
					<div class="delbox">
						<span class="small">
							If this box is checked, this profile will be removed upon submit<br />
						</span>
						<input name="<?= $content["id"]; ?>-del" type="checkbox" />
					</div>
				</div>
			</div> <?PHP       	
		} ?>
        </fieldset> <?PHP
	}


	/*
		private helper function for building the member editing form. responsible for
		creating the radio buttons and checkbox indicating team and ec position
	*/

	function buildRadios($content) {
		$teams = ["None", "Rush", "Social", "Philanthropy"];
		$i = -1;
		while ($i < 3) { ?>
			<input type="radio" name="<?= $content["id"]; ?>-team" value="<?= $i; ?>" <?PHP
			if ($i == $content["team"]) { ?>
				checked <?PHP
			} ?>
			> <?= $teams[$i + 1]; ?> <?PHP
			$i++;
		} ?>
		<input type="checkbox" name="<?= $content["id"]; ?>-ec" <?PHP 
			if ($content["exec"] == 1) { ?>
				checked <?PHP
			} ?>
		>EC Member? <?PHP
	}

	/*
		generates the html for a form that allows the user to upload a photo to the gallery
	*/

	function genAddPhoto() { ?>
		<form method="POST" action="cp/update.php?edit=gallery&page=add" 
				enctype="multipart/form-data">
			<table>
				<tr>
					<td class="formLabel">Photo Title:</td>
					<td><input name="header" type="text" class="team-header" /></td>
				</tr>
				<tr>
					<td class="formLabel">Photo Description:</td>
					<td><input name="content" type="text" class="team-header" /></td>
				</tr>
				<tr>
					<td class="formLabel">Image Upload (jpg, jpeg, png allowed):</td>
					<td>
					<input name="img" class="team-upload" type="file" />
					<div class="infobox">
						<span class="small">
							<ul>
								<li>1.3 mb limit</li>
								<li>.png format only</li>
								<li>well be stretched to 500px width</li>
								<li>USE COMMON SENSE ON WHAT YOU UPLOAD</li>
							</ul>
						</span>
					</div>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Upload To Photo Gallery" /></td>
				</tr>
			</table>
		</form> <?PHP	
	}
?>