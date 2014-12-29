<?PHP
	// upload.php - the api for uploading photos to our database

	// verify that file is of specified type
	function verifyFileType($name, $allowed) {
		// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
		// Check MIME Type by yourself.
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		if (false === $ext = array_search(
			$finfo->file($_FILES[$name]['tmp_name']),
			$allowed,
			true)) {
			return false;
		}
		return true;
	}

	// helper function that checks if a file was submitted and uploads it if it
	// is valid for bio thumbnails
	function uploadBioThumbnail($prefix, $id) {
		$name = $prefix."img";
		if (isset($_FILES[$name]) && $_FILES[$name]["error"] == 0) {
			if (verifyFileType($name, ["image/png"])) {
				$dimension = getimagesize($_FILES[$name]["tmp_name"]);
				if (($dimension[0] >= 297 && $dimension[0] <= 303) 
						&& ($dimension[1] >= 197 && $dimension[1] <= 203)) {
					if (file_exists("../layout/bio/".$id.".png")) {
						unlink("../layout/bio/".$id.".png");
					}
					move_uploaded_file($_FILES[$name]["tmp_name"],
						"../layout/bio/".$id.".png");
                    return;
				}
			}
		}
		copy("../layout/bio/default.png", "../layout/bio/".$id.".png");
	}
?>