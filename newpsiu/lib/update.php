<?PHP
include("boilerplate.php");
include("lock.php");

if (isset($_GET["src"])) {
	$page = $_GET["src"];
	if ($page == "Home") {
		updateHome();
	} else if ($page == "Values") {
		updateValues();
	} else if ($page == "Officers") {
		updateOfficers();
	} else if ($page == "Contact") {
		updateContact();
	} else if ($page == "Calendar") {
		updateCalendar();
	}
}

// Function to call when updating homepage
function updateHome() {
	$headers = array(
		1 => $_POST["header_1"], 
		2 => "Recent News", 
		3 =>$_POST["header_3"]);
	$contents = array(
		1 => $_POST["content_1"],
		2 => $_POST["content_2"], 
		3 => $_POST["content_3"]);
	for ($i = 1; $i <= 3; $i++) {
		$params = array(":header" => $headers[$i], ":content" => $contents[$i], ":id" => $i);
		sqlPerform("UPDATE Home SET header = :header, content = :content WHERE id = :id", $params);
	}
}

// Function to call when updating values page
function updateValues() {
	$headers = array(
		1 => $_POST["header_1"], 
		2 => $_POST["header_2"], 
		3 =>$_POST["header_3"]);
	$contents = array(
		1 => $_POST["content_1"],
		2 => $_POST["content_2"], 
		3 => $_POST["content_3"]);
	for ($i = 1; $i <= 3; $i++) {
		$params = array(":header" => $headers[$i], ":content" => $contents[$i], ":id" => $i);
		sqlPerform("UPDATE About SET header = :header, content = :content WHERE id = :id", $params);
	}
}

// Function to call when updating officers page
function updateOfficers() {
	for ($i = 1; $i < 12; $i++) {
		$params = array(":header" => $_POST[$i."_header"], ":content" => $_POST[$i."_content"], ":id" => $i+1);
		sqlPerform("UPDATE Officers SET header = :header, content = :content WHERE id = :id", $params);
	}
	$params = array(":header" => $_POST["intro_header"], ":content" => $_POST["intro_content"], ":id" => 1);
	sqlPerform("UPDATE Officers SET header = :header, content = :content WHERE id = :id", $params);
}

// Function to call when updating contact page
function updateContact() {
	// update intro part
	sqlPerform("UPDATE Contact SET header = :header, content = :content WHERE id = 1", array(":header" => $_POST["intro_header"], ":content" => $_POST["intro_content"]));
	// for each team, store the id values of each member in an array
	$rush = sqlFetchAll("SELECT id FROM Contact WHERE team = 1");	
	$social = sqlFetchAll("SELECT id FROM Contact WHERE team = 2");	
	$philanthropy = sqlFetchAll("SELECT id FROM Contact WHERE team = 3");	
	// iterate through those ids and update accordingly
	iterateThroughTeam($rush);
	iterateThroughTeam($social);
	iterateThroughTeam($philanthropy);
}

// helper function for updateContact
function iterateThroughTeam($team) {
	foreach($team as $a) {
		$info = $_POST[$a["id"]."_name"]."::".$_POST[$a["id"]."_home"]."::".$_POST[$a["id"]."_major"]."::".$_POST[$a["id"]."_phone"]."::".$_POST[$a["id"]."_email"];
		$params = array(":header" => $_POST[$a["id"]."_header"], ":bio" => $_POST[$a["id"]."_bio"], ":info" => $info, ":id" => $a["id"]); 
		sqlPerform("UPDATE Contact SET header = :header, bio = :bio, info = :info WHERE id = :id", $params);	
	}
}

// Function to call when updating contact page
function updateCalendar() {
	// first iterate thru existing events and check for updates or deletion
	$ids = sqlFetchAll("SELECT id FROM Calendar");
	foreach ($ids as $id) {
		if (isset($_POST[$id["id"]."_del"])) {
			$params = array(":id" => $id["id"]);
			sqlPerform("DELETE FROM Calendar WHERE id = :id", $params);
		} else if (checkdate($_POST[$id["id"]."_month"], $_POST[$id["id"]."_day"], date('Y'))) {
			$date = date('Y')."-".$_POST[$id["id"]."_month"]."-".$_POST[$id["id"]."_day"];
			$params = array(":title" => $_POST[$id["id"]."_title"], ":details" => $_POST[$id["id"]."_details"], ":date" => $date, ":id" => $id["id"]);
			sqlPerform("UPDATE Calendar SET title = :title, details = :details, date = :date WHERE id = :id", $params);
		}
	}
	// insert new event if there is one
	if (!isset($_POST["-1_del"]) && checkdate($_POST["-1_month"], $_POST["-1_day"], date('Y'))) {
		$date = date('Y')."-".$_POST["-1_month"]."-".$_POST["-1_day"];
		$params = array(":title" => $_POST["-1_title"], ":details" => $_POST["-1_details"], ":date" => $date);
		sqlPerform("INSERT INTO Calendar (date, title, details) VALUES (:date, :title, :details)", $params);
	}
}

header("Location: ../admin.php");
?>
