<?PHP
	// MySQL setup
	$dbname = "";
	$dbhost = "";
	$dbuser = "";
	$dbpass = "";
		
	// returns a PDO object connected to the database ready for queries
	function connectDB() {
		global $dbname;
		global $dbhost;
		global $dbuser;
		global $dbpass;
		return new PDO("mysql:host=".$dbhost.";port=3306;dbname=".$dbname, $dbuser, $dbpass); 
	}

	// performs a fetch() instruction and returns an array of the results or NULL
	function sqlPerform($statement, $values = array()) {
		$database = connectDB();
		$instruction = $database->prepare($statement);
		$instruction->execute($values);
		$result = $instruction->fetch();
		return (!empty($result)) ? $result : NULL;
	}
	
	// performs a fetchAll instruction and returns array or NULL
	function sqlFetchAll($statement, $values = array()) {
		$database = connectDB();
		$instruction = $database->prepare($statement);
		$instruction->execute($values);
		$result = $instruction->fetchAll();
		return (!empty($result)) ? $result : NULL;
	}
	
	// THIS FUNCTION IS GOING TO BE PHASED OUT OVER TIME! Each page will have exlusive getter functions
	// Retrieve a piece of content by ID and immediately convert it to HTML
	// for (header/content) data only!
	function displayContent($table, $id) {
		$result = sqlPerform("SELECT header, content FROM ".$table." WHERE id = ".$id);
		if ($result != NULL) {
?>
<h3><?= $result["header"] ?></h3>
<?= $result["content"] ?>
<?PHP	
		} else {
			echo("error loading content, please contact admin");
		}
	}
?>