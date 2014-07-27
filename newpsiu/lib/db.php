<?PHP
  // MySQL setup
  include("../../info.php");
  try {
    $db = new PDO("mysql:host=".$dbhost.";port=1818;dbname=".$dbname, $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    $db = null;
  }
  $pages = ["Home", "Values", "Officers", "Contact", "Calendar", "Photos", "Faq"];

  // returns the id number associated with the name of a page
  function findPageId($name) {
    global $pages;
    return array_search($name, $pages);
  }

  // performs a fetch() instruction and returns an array of the results or NULL
  function dbQuery($statement, $values = array()) {
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
      $result = $instruction->fetch();
    } catch(PDOException $e) {
      $result = null;
      echo($e);
    }
    return $result;
  }
  
  // standard content: extracts header and content fields row from the table
  function genStandardContent($tablename, $offset, $showDate = true) {
    $pid = findPageId($tablename);
    if ($pid === false) { ?>
      <div>Setup Error! Page id not found.</div> <?PHP
      return;
    }

    $data = dbQuery("SELECT header, content, edited 
                      FROM standardContent 
                      WHERE pid = :pid
                      LIMIT 1 OFFSET :off", [":pid"=>$pid, ":off"=>$offset]);
    if ($data != null) { ?>
      <h3><?= htmlspecialchars_decode($data[0]); ?></h3>
      <div>
        <?= htmlspecialchars_decode($data[1]); ?>
        <?PHP if ($showDate == true): ?>
        <p>last updated: <?= htmlspecialchars_decode($data[2]); ?></p> 
        <?PHP endif; ?>
      </div> <?PHP
      return;
    } ?>
    <div>Database Error! Content not found in table.</div> <?PHP
  }

  // function bio content: extracts header, info, and content fields from table
  // info field will be string parsed with the following pattern
  // name::hometown::major::phone::email
  function genBio($tablename, $id) {
    $data = dbQuery("SELECT header, info, content FROM ".$tablename." WHERE id = :id",
      [":id"=>$id]);
    if ($data != null) { 
      $info = explode("::". $data["info"]);
      ?>
      <div class="row narrow">
        <h3><?= $data["header"] ?></h3>
        <div class="col-md-3">
          <img src="images/bio/".$id.".jpg" alt="<?= $data["header"]; ?>" />
        </div>
        <div class="col-md-9">
          <table>
            <tr>
              <th>Nickname</th>
              <th>Hometown</th>
              <th>Major</th>
              <th>Phone</th>
              <th>Email</th>
            </tr>
            <tr>
              <td><?= $info[0]; ?></td>
              <td><?= $info[1]; ?></td>
              <td><?= $info[2]; ?></td>
              <td><?= $info[3]; ?></td>
              <td><?= $info[4]; ?></td>
            </tr>
        </div>
      </div> <?PHP
    } else { ?>
      <div>Database Error!</div> <?PHP
    }
  }

  // TODO: a picture collage generator
?>