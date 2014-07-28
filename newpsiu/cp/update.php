<?PHP
  session_start();
  include("../lib/db.php");
  if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true 
    || !isset($_GET["edit"]) || !isset($_GET["page"])) {
    header("Location: ../login.php");
    die();
  } 

  $pid = findPageId($_GET["page"]);
  if ($pid !== false) {
    if ($_GET["edit"] == "static") {
      $ids = dbQuery("SELECT id FROM standardContent WHERE pid = :pid", [":pid"=>$pid], true);
      $query = "UPDATE standardContent 
          SET header = :hd, content = :cnt
          WHERE id = :id";
      foreach($ids as $curr) {
        $params = [":hd"=>$_POST[$curr["id"]."-header"],
                    ":cnt"=>$_POST[$curr["id"]."-content"],
                    ":id"=>$curr["id"]];
        // TODO: Calling dbQuery executes a fetch statement. This causes it to catch an error
        // because the query has no results to fetch. 
        // Since database still updates, I'm ignoring this issue for now. It will require
        // reorganizing some function logic
        dbQuery($query, $params);
      }
    }
  }
  header("Location: ../admin.php?edit=".$_GET["edit"]."&page=".$_GET["page"]);
?>