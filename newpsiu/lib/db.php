<?PHP
  // MySQL setup
  include("../../info.php");
  try {
    $db = new PDO("mysql:host=".$dbhost.";port=1818;dbname=".$dbname, $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    $db = null;
    echo($e);
  }

  // performs a fetch() instruction and returns an array of the results or NULL
  function dbQuery($statement, $values = array()) {
    global $db;
    try {
      $instruction = $db->prepare($statement);
      $instruction->execute($values);
      $result = $instruction->fetchAll();
    } catch(PDOException $e) {
      $result = null;
      echo($e);
    }
    return $result;
  }
  
  // standard content: table must have a "header" and "content" column
  function genStandardContent($tablename, $id) {
    $data = dbQuery("SELECT 'header', 'content' FROM ".$tablename." WHERE id = :id", [":id"=>$id]);
    if ($data != null) { ?>
      <h3><?= $data[0]["header"]; ?></h3>
      <div><?= $data[0]["content"]; ?></div> <?PHP
    } else { ?>
      <div>Database Error! Content failed to load</div> <?PHP
    }
  }
?>