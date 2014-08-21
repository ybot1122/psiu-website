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
				$query = $query."pid = :".$page." ORDER BY `pid` ASC , `id` ASC";
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
							Rush", "Social", "Philanthropy"
			$ec 	=> 	if set to true, ec members will not be grouped with their team
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
					$query = $query." AND exec != -1";
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
?>