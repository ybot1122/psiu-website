<?PHP
	// templates/bios.php - specialized functions for producing displays for member bios

	/*
		generates html for a flat display of bios
			$data 		=>	array of objects that contain the following properties:
								"id": the unique id of this member
								"team": id of the team of this member is on
								"exec": identify if this member is on exec council
								"header": content to be wrapped in <h2>
								"content": content to be wrapped in a <div>
								"info": properly formatted string to be rendered into a <table>
								"edited": timestamp of when this post was last updated
			$timestamp 	=> 	true to display when post was last updated, false to hide it
	*/

	function bioFlatDisplayRender($data, $timestamp) {
		foreach ($data as $curr) { ?>
			<div class="row narrow"> <?PHP
			if (!isset($curr["id"]) || !isset($curr["team"]) 
					|| !isset($curr["exec"]) || !isset($curr["header"]) 
					|| !isset($curr["content"]) || !isset($curr["info"])
					|| ($timestamp === true && !isset($curr["edited"]))) {
				errorContentRender(0);
				continue;
			} 
			$info = explode("::", $curr["info"]); ?>
			<div class="col-md-3">
				<img class="img-responsive img-rounded"
					src="layout/bio/<?= $curr["id"]; ?>.png" alt="<?= $curr["header"]; ?>" />
			</div>
			<div class="col-md-8">
				<h3><?= $curr["header"]; ?></h3>
				<table>
					<tr> <?PHP
					if (count($info) != 5) { ?>
						<td colspan="5">
							Content Error! Info for this bio is malformed.
						</td> <?PHP
					} else { ?>
						<td><?= $info[0]; ?></td>
						<td><?= $info[1]; ?></td>
						<td><?= $info[2]; ?></td>
						<td><?= $info[3]; ?></td>
						<td><?= $info[4]; ?></td> <?PHP
					} ?>
					</tr>
				</table>
				<div>
					<?= $curr["content"]; ?>
				</div>
				<?PHP if ($timestamp === true) { ?>
				<p><?= $curr["edited"]; ?></p>
				<?PHP } ?>
			</div>
			</div> <?PHP
		}
	}

	/*
		generates html for a tabbed display of bios
			$data 		=>	array of objects that contain the following properties:
								"id": the unique id of this member
								"team": id of the team of this member is on
								"exec": identify if this member is on exec council
								"header": content to be wrapped in <h2>
								"content": content to be wrapped in a <div>
								"info": properly formatted string to be rendered into a <table>
								"edited": timestamp of when this post was last updated
			$timestamp 	=> 	true to display when post was last updated, false to hide it
	*/

	function bioTabDisplayRender($data, $timestamp) { 
		if (empty($data) || count($data) === 0) {
			errorContentRender(2);
			return;
		}
		?>
		<ul class="nav nav-tabs"> <?PHP
		for ($i = 0; $i < count($data); $i++) { ?>
			<li <?PHP if ($i == 0) { ?>class="active"<?PHP } ?>>
				<a href="#<?= $data[$i]["team"]; ?>-<?= $i; ?>" 
					data-toggle="tab"><?= $data[$i]["header"]; ?></a>
			</li> <?PHP
		} ?>
		</ul> 
		<div class="tab-content"> <?PHP
		for ($i = 0; $i < count($data); $i++) { ?>
			<div class="tab-pane<?PHP if ($i == 0) { ?> active<?PHP } ?>" 
					id="<?= $data[$i]["team"]; ?>-<?= $i; ?>"> <?PHP
				bioFlatDisplayRender([$data[$i]], $timestamp); ?>
			</div> <?PHP
		} ?>
		</div> <?PHP
	}
?>