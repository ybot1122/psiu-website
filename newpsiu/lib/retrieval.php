<?PHP
	// retrieval.php - wrapper functions that query the database and return results

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

?>