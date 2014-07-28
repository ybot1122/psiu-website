<?PHP
  // MySQL setup
  include(dirname(__DIR__)."/../../info.php");
  try {
    $db = new PDO("mysql:host=".$dbhost.";port=1818;dbname=".$dbname, $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    $db = null;
  }
  $pages = ["Home", "Values", "Officers", "Contact", "Calendar", "Photos", "Faq"];
  $teams = ["Rush", "Social", "Philanthropy"];

  // returns the id number associated with the name of a page
  function findPageId($name) {
    global $pages;
    return array_search($name, $pages);
  }

  // returns the id number associated with the name of a page
  function findTeamId($name) {
    global $teams;
    return array_search($name, $teams);
  }

  // performs a fetch() instruction and returns an array of the results or NULL
  function dbQuery($statement, $values = array(), $all = false) {
    global $db;
    try {
      $instruction = $db->prepare($statement);
      // loop through values and bind param based on type
      foreach($values as $key => $item) {
        if (gettype($item) == "integer") {
          $instruction->bindValue($key, $item, PDO::PARAM_INT);
        } else {
          $instruction->bindValue($key, $item, PDO::PARAM_STR);
        }
      }
      $instruction->execute();
      if (!$all) {
        $result = $instruction->fetch();
      } else {
        $result = $instruction->fetchAll();
      }
    } catch(PDOException $e) {
      $result = null;
      echo($e);
    }
    return $result;
  }
?>