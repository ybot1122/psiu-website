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

	function updateStaticContent($pid) {
		$ids = dbQuery("SELECT id FROM standardContent WHERE pid = :pid", [":pid"=>$pid], true);
		$query = "UPDATE standardContent 
				SET header = :hd, content = :cnt
				WHERE id = :id";
		foreach($ids as $curr) {
			$params = [
				":hd"=>$_POST[$curr["id"]."-header"],
				":cnt"=>$_POST[$curr["id"]."-content"],
				":id"=>$curr["id"]
			];
			dbPerform($query, $params);
		}
	}
	
	function addTeamMember() {
		$query = "INSERT INTO bioContent (team, exec, header, content, info)
				VALUES (:tid, :exec, :hd, :cnt, :info)";
		$tid = $_POST["team"];
		$ec = (isset($_POST["ec"])) ? 1 : 0;
		$info = $_POST["nickname"]."::".$_POST["hometown"]."::".$_POST["major"].
				"::".$_POST["phone"]."::".$_POST["email"];
		$params = [
			":tid" => $tid,
			":exec" => $ec,
			":hd" => $_POST["header"],
			":cnt" => $_POST["content"],
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
				$info = $_POST[$curr["id"]."-nickname"]."::".$_POST[$curr["id"]."-hometown"]."::".
						$_POST[$curr["id"]."-major"]."::".$_POST[$curr["id"]."-phone"]."::".
						$_POST[$curr["id"]."-email"];
				$ec = (isset($_POST[$curr["id"]."-ec"])) ? 1 : 0;
				$params = [
					":hd"=>$_POST[$curr["id"]."-header"],
					":cnt"=>$_POST[$curr["id"]."-content"],
					":info"=>$info,
					":id"=>$curr["id"],
					":team"=>$_POST[$curr["id"]."-team"],
					":exec"=>$ec
				];
				dbPerform($query, $params);
				uploadBioThumbnail($curr["id"]."-", $curr["id"]);
			}
		}
	}

	function addPhoto() {
		if (isset($_POST["header"]) && isset($_POST["content"]) && isset($_FILES["img"])) {
			if (verifyFileType("img", ["image/png"])) {
				$query = "INSERT INTO galleryContent (header, content) VALUES (:hd, :cnt)";
				$params = [":hd" => $_POST["header"], ":cnt" => $_POST["content"]];
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
			if (isset($_POST[$curr["id"]."-del"])) {
				dbPerform("DELETE FROM galleryContent WHERE id = :id", [":id" => $curr["id"]]);
				if (file_exists("../layout/gallery/".$id.".png")) {
					unlink("../layout/gallery/".$id.".png");
				}
			} else {
				$params = [":hd"=>$_POST[$curr["id"]."-header"],
				":cnt"=>$_POST[$curr["id"]."-content"],
				":id"=>$curr["id"]];
				dbPerform($query, $params);
			}
		}
	}	
?>