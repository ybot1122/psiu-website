<?PHP
	// cp/templates/gallery.php - functions to generate the forms for editing team bios

	/*
		generates the html for a form that allows the user to upload a photo to the gallery
	*/

	function photoAddFormRender() { ?>
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

	/*
		generates the html for forms that allow editing and removal of existing photos
			$data 	=> 	an array of associative arrays, where each member has the following
							"header": title of photos
							"content": photo description/caption
							"id": id of this photo
	*/

	function galleryEditFormRender($content) { ?>
		<form method="POST" action="cp/update.php?edit=gallery&page=main"> <?PHP
		foreach($content as $panel) { ?>
			<div class="row">
				<div class="col-md-3">
					<img class="img-responsive img-rounded" 
							src="layout/gallery/<?= $panel["id"]; ?>.png" />
					<div class="delbox">
						<span class="small">
							If this box is checked, this photo will be removed upon submit<br />
						</span>
						<input name="<?= $panel["id"]; ?>-del" type="checkbox" />
					</div>
				</div>
				<div class="col-md-9">
					<fieldset>
						<input name="<?= $panel["id"]; ?>-header" class="static-header" 
								type="text" value="<?= $panel["header"]; ?>" />
						<textarea name="<?= $panel["id"]; ?>-content"
								class="static-content"><?= $panel["content"]; ?></textarea>
					</fieldset> 
				</div>
			</div> <?PHP
		} ?>
		<input type="submit" value="Submit!" />
		</form> <?PHP
	}
?>