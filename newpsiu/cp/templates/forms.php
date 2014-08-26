<?PHP
	// cp/templates/forms.php 

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
			<textarea name="<?= $panel["id"]; ?>-content" 
					class="static-content"><?= $panel["content"]; ?></textarea>
	      </fieldset> <?PHP
	    } ?>
	      <input type="submit" value="Submit!" />
	    </form> <?PHP
	}
?>