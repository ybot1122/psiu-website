<?PHP
	// cp/update.php - checks and makes the corresponding database query to update

	session_start();
	include("../lib/lock.php");
	include("../lib/db.php");
	include("upload.php");

	if (!isset($_GET["edit"]) || !isset($_GET["page"])) {
		header("Location: ../login.php");
		die();
	} 

	$pid = findPageId($_GET["page"]);

	if ($pid !== false) {
		// static content updating
		if ($_GET["edit"] == "static") {
			updateStaticContent($pid);
		}
	} else if ($_GET["edit"] == "teams") {
		// edit/remove existing team members
		if ($_GET["page"] == "main") {
			updateTeamMembers();
		}
		// add a new team member
		if ($_GET["page"] == "add") {
			addTeamMember();
		}
	} else if ($_GET["edit"] == "gallery") {
		// edit/remove existing photos
		if ($_GET["page"] == "main") {
			updatePhotoGallery();
		}
		// add a new photo
		if ($_GET["page"] == "add") {
			addPhoto();
		}
	}

	header("Location: ../admin.php?edit=".$_GET["edit"]."&page=".$_GET["page"]);

	/*
		returns an array of the POST form values associated with the provided id
			$prefix 	=>	value representing the unique identifier of this set of data
			$fields 	=>	array of strings representing the keys expected in the returned
							array
	*/

	function getInputByPrefix($prefix, $fields) {
		$result = [];
		foreach ($fields as $str) {
			if (isset($_POST[$prefix.$str])) {
				$result[$str] = $_POST[$prefix.$str];
			} else {
				$result[$str] = null;
			}
		}
		return $result;
	}

	function updateStaticContent($pid) {
		$ids = dbQuery("SELECT id FROM standardContent WHERE pid = :pid", [":pid"=>$pid], true);
		$query = "UPDATE standardContent 
				SET header = :hd, content = :cnt
				WHERE id = :id";
		foreach($ids as $curr) {
			$input = getInputByPrefix($curr["id"]."-", ["header", "content"]);
			$params = [
				":hd"	=>	$input["header"],
				":cnt"	=>	$input["content"],
				":id"	=>	$curr["id"]
			];
			dbPerform($query, $params);
		}
	}
	
	function addTeamMember() {
		$query = "INSERT INTO bioContent (team, exec, header, content, info)
				VALUES (:tid, :exec, :hd, :cnt, :info)";
		$input = getInputByPrefix("", ["team", "ec", "nickname", "hometown", "major", "phone",
				"email","header", "content"]);
		$tid = $input["team"];
		$ec = (isset($input["ec"])) ? 1 : 0;
		$info = $input["nickname"]."::".$input["hometown"]."::".$input["major"].
				"::".$input["phone"]."::".$input["email"];
		$params = [
			":tid" => $tid,
			":exec" => $ec,
			":hd" => $input["header"],
			":cnt" => $input["content"],
			":info" => $info
		];
		dbPerform($query, $params);
		$id = dbQuery("SELECT id FROM bioContent ORDER BY edited DESC LIMIT 1")["id"];
		uploadBioThumbnail("", $id);
	}

	function updateTeamMembers() {
		$ids = dbQuery("SELECT id FROM bioContent", [], true);
		$query = "UPDATE bioContent 
				SET header = :hd, content = :cnt, info = :info, team = :team, exec = :exec
				WHERE id = :id";
		foreach($ids as $curr) {
			// if marked for removal, delete it
			if (isset($_POST[$curr["id"]."-del"])) {
				// remove
				dbPerform("DELETE FROM bioContent WHERE id = :id", [":id" => $curr["id"]]);
			} else {
				$input = getInputByPrefix($curr["id"]."-", ["nickname", "hometown", "major",
						"phone", "email", "ec", "header", "content", "team"]);
				$info = $input["nickname"]."::".$input["hometown"]."::".$input["major"]."::".
						$input["phone"]."::".$input["email"];
				$ec = ($input["ec"] != null) ? 1 : 0;
				$params = [
					":hd"	=>	$input["header"],
					":cnt"	=>	$input["content"],
					":info"	=>	$info,
					":id"	=>	$curr["id"],
					":team"	=>	$input["team"],
					":exec"	=>	$ec
				];
				dbPerform($query, $params);
				uploadBioThumbnail($curr["id"]."-", $curr["id"]);
			}
		}
	}

	function addPhoto() {
		$input = getInputByPrefix("", ["header", "content"]);
		if ($input["header"] !== null && $input["content"] !== null && isset($_FILES["img"])) {
			if (verifyFileType("img", ["image/png"])) {
				$query = "INSERT INTO galleryContent (header, content) VALUES (:hd, :cnt)";
				$params = [":hd" => $input["header"], ":cnt" => $input["content"]];
				dbPerform($query, $params);
				$id = dbQuery("SELECT id FROM galleryContent ORDER BY edited DESC LIMIT 1")[0];
				move_uploaded_file($_FILES["img"]["tmp_name"], "../layout/gallery/".$id.".png");
			}
		}
	}

	function updatePhotoGallery() {
		$ids = dbQuery("SELECT id FROM galleryContent", [], true);
		$query = "UPDATE galleryContent
				SET header = :hd, content = :cnt
				WHERE id = :id";
		foreach($ids as $curr) {
			$input = getInputByPrefix($curr["id"]."-", ["header", "content", "del"]);
			if ($input["del"] !== null) {
				dbPerform("DELETE FROM galleryContent WHERE id = :id", [":id" => $curr["id"]]);
				if (file_exists("../layout/gallery/".$curr["id"].".png")) {
					unlink("../layout/gallery/".$curr["id"].".png");
				}
			} else {
				$params = [
					":hd"	=>	$input["header"],
					":cnt"	=>	$input["content"],
					":id"	=>	$curr["id"]
				];
				dbPerform($query, $params);
			}
		}
	}	
?>