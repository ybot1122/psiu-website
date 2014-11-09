<?PHP

	// cp/calUpdate.php - common functions used across multiple admin functions

	/*
		Returns an array of user input values from a POST submission based on the
		selector prefix and field names provided
			$prefix 	=> 	a string with the prefix that all the field names have
			$fields 	=>  an array of strings that identify field names
		If a certain POST variable is not set, it will return "No Content Available"
		in that field's value instead
	*/
	function getInputByPrefix($prefix, $fields) {
		$result = [];
		foreach ($fields as $str) {
			if (isset($_POST[$prefix.$str])) {
				$result[$str] = $_POST[$prefix.$str];
			} else {
				$result[$str] = "No Content Available";
			}
		}
		return $result;
	}

	/*
		Deletes the row uniquely identified by the given id from the table provided
	*/
	function deleteById($table, $id) {
		/*
			TODO: verify that table and id are properly formatted
		*/
		$delQuery = "DELETE FROM " . $table . " WHERE id = :id";
		dbPerform($delQuery, [":id" => $id]);
		/*
			TODO:
			once dbPerform is wired up to return success/failure we can do
			$status = dbPerform($delQuery);
			if ($status) { ... };
		*/
	}
?>