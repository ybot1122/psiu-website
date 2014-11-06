<?PHP

	// cp/calUpdate.php - page to process event management forms specifically

	session_start();
	include("../lib/lock.php");
	include("../lib/db.php");
	include("upload.php");

	if (!isset($_GET["action"])) {
		header("Location: ../login.php");
		die();
	} 

	if ($_GET["action"] == "add" && isset($_POST["title"]) 
	&& isset($_POST["desc"])) {
		// add a new event to our database
		// TODO: check if the specified date is valid
		$date = "2014-11-27";
		$query = "INSERT INTO events (title, description, date) VALUES (:ti, :dsc, :dte)";
		$params = [":ti" => $_POST["title"], ":dsc" => $_POST["desc"], ":dte" => $date];
		dbPerform($query, $params);
	}

	header("Location: ../admin.php?edit=events&page=main");
?>