<?PHP
	// cp/calUpdate.php - page to process event management forms specifically

	session_start();
	include("../lib/lock.php");
	include("../lib/db.php");
  include("message.php");
	include("cp_func.php");

	if (!isset($_GET["action"])) {
		header("Location: ../login.php");
		die();
	} 

	if ($_GET["action"] == "add" && isset($_POST["title"]) 
	&& isset($_POST["desc"]) && isset($_POST["month"]) && isset($_POST["day"])) {
		// add a new event to our database
		// TODO: check if the specified date is valid
		if (checkdate($_POST["month"], $_POST["day"], date("Y"))) {
			$date = date("Y") . "-" . $_POST["month"] . "-" . $_POST["day"];
			$query = "INSERT INTO events (title, description, date) VALUES (:ti, :dsc, :dte)";
			$params = [":ti" => $_POST["title"], ":dsc" => $_POST["desc"], ":dte" => $date];
      appendMessage("Event added successfully"); 
			dbPerform($query, $params);
		} else {
      appendMessage("Invalid date, event not added"); 
    }
	} else if ($_GET["action"] == "update") {
		// retrive all IDs of events from today onward
		$ids = dbQuery("SELECT id FROM events WHERE date >= CURDATE()", [], true);
		// iterate through events and make updates
		foreach($ids as $curr) {
			$prefix = $curr["id"]."-";
			if (isset($_POST[$prefix."del"])) {
				deleteById("events", $curr["id"]);
			} else {
				$updateQuery = "UPDATE events 
					SET title = :hd, description = :cnt, date = :dte
					WHERE id = :id";
				$input = getInputByPrefix($curr["id"]."-", ["title", "desc", "month", "day"]);
				if (checkdate($input["month"], $input["day"], date("Y"))) {
					$date = date("Y") . "-" . $input["month"] . "-" . $input["day"];
					$params = [
						":hd"	=>	$input["title"],
						":cnt"	=>	$input["desc"],
						":dte"  =>  $date,
						":id"	=>	$curr["id"]
					];
					dbPerform($updateQuery, $params);
				} else {
          appendMessage("Invalid date, event not updated"); 
        }
			}
		}
    appendMessage("Update successful"); 
	} else {
    appendMessage("All fields required"); 
  }

	header("Location: ../admin.php?edit=events&page=main");
?>