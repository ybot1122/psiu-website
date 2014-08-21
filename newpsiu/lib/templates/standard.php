<?PHP
	// templates/standard.php - highest level, most common html content panels

	/*
		generates html for a 'static' content panel. 
				$data 	=> 	array of objects that contian the following properties:
								"header": the content to be wrapped in <h2>
								"content": the content to be put in the body of panel
								"edited": timestamp of when this post was last updated
			$timestamp 	=> 	true to display when post was last updated, false to hide it
	*/

	function staticContentRender($data, $timestamp) {
		if (!isset($data["header"]) || !isset($data["content"])
				|| ($timestamp === true && !isset($data["edited"]))) {
			errorContentRender(0);
		} ?>
		<h2><?= $data["header"]; ?></h2>
		<div>
			<?= $data["content"]; ?>
		</div> <?PHP
		if ($timestamp === true) { ?>
			<p>last updated: <?= $data["edited"]; ?></p> <?PHP
		}
	}

	/* generates html for an error message, if a content panel messes up.
			$message 	=> 	the code for the error message to display
				0: malformed data passed to rendering function
				1: database query failed
				2: database query returned no results
	*/

	function errorContentRender($message) {
		$msgs = [
			"malformed data passed to rendering function",
			"database query error",
			"database query returned no results"]; ?>
		<div class="row">
			<div class="col-md-12">
				<h2>error loading content</h2>
				<p><?= $msgs[$message]; ?></p>
			</div>
		</div> <?PHP
	}



?>