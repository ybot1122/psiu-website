<?PHP
	// retrieval.php - wrapper functions that query the database and return results
	// basically the API for getting data

	/*
		retrieve static content from database
			$pagename 	=>	array of capitalized strings of the names of pages to
							retrieve data for
		returns an array of associative arrays on success, null on failure
	*/
	function getStaticContent($pagename) { 
		$pages = ["Home", "Values", "Officers", "Contact", "Calendar", "Photos", "Faq"];
		$query = "SELECT * FROM standardContent WHERE ";
		$params = [];
		foreach ($pagename as $page) {
			if (($id = array_search($page, $pages)) == -1) {
				return null;
			}
			$params[":".$page] = $id;
			if (count($params) === count($pagename)) {
				$query = $query."pid = :".$page." ORDER BY `pid` ASC, `id` ASC";
			} else {
				$query = $query."pid = :".$page." OR ";
			}
		}
		$result = dbQuery($query, $params, true);
		return $result;
	}

	/*
		retrieve bio data from database
			$team 	=> 	array of captialized strings of team names
							Rush", "Social", "Philanthropy", "Ec"
			$ec 	=> 	if set to true, ec members will be grouped as EC,
						regardless of their team
		returns an associative array of associative arrays. The outer array is organized
		by team name, the inner arrays are of individual members
	*/
	function getTeamContent($team, $ec) {
		$teams = ["Rush", "Social", "Philanthropy"];
		$result = [];
		foreach ($team as $curr) {
			if ($curr === "Ec") {
				if ($ec === true) {
					$query = "SELECT * FROM bioContent WHERE exec = 1";
				} else {
					$query = "SELECT * FROM bioContent WHERE exec = 1 AND team = -1";
				}
				$params = [];
			} else {
				$query = "SELECT * FROM bioContent WHERE team = :tid";
				if ($ec === true) {
					$query = $query." AND exec = 0";
				}
				if (($tid = array_search($curr, $teams)) !== -1) {
					$params = [":tid" => $tid];
				} else {
					$result[$curr] = null;
					continue;
				}
			}
			$result[$curr] = dbQuery($query, $params, true);
		}
		return $result;
	}

	/*
		retrieve gallery data from database

		returns an associative arrays of associative arrays
	*/
	function getGalleryContent() {
		$result = dbQuery("SELECT * FROM galleryContent", [], true);
		return $result;
	}

	/*
		retrieve all events that start on the given date or after

		the date should be a string of the following format:
		mm/dd/yyyy
	*/
	function getEvents($startDate) {
		$result = dbQuery("SELECT * FROM events WHERE date >= :d",
			[":d" => $startDate], true);
		return $result;
	}
?>