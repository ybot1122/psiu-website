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
    // static content updating
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
        dbPerform($query, $params);
      }
    }
  } else {
    // making updates to teams (editing and removing)
    if ($_GET["edit"] == "teams" && $_GET["page"] == "main") {
      $ids = dbQuery("SELECT id FROM bioContent", [], true);
      $query = "UPDATE bioContent 
          SET header = :hd, content = :cnt, info = :info
          WHERE id = :id";
      foreach($ids as $curr) {
        // if marked for removal, delete it
        if (isset($_POST[$curr["id"]."-del"])) {
          // remove
          dbPerform("DELETE FROM bioContent WHERE id = :id", [":id" => $curr["id"]]);
        } else {
          $info = $_POST[$curr["id"]."-nickname"]."::".$_POST[$curr["id"]."-hometown"]."::".
            $_POST[$curr["id"]."-major"]."::".$_POST[$curr["id"]."-phone"]."::".
            $_POST[$curr["id"]."-email"];
          $params = [":hd"=>$_POST[$curr["id"]."-header"],
                      ":cnt"=>$_POST[$curr["id"]."-content"],
                      ":info"=>$info,
                      ":id"=>$curr["id"]];
          // TODO: same as above
          dbPerform($query, $params);
        }
      }
    }
    // making updates to teams by adding a new member
    if ($_GET["edit"] == "teams" && $_GET["page"] == "add") {
      $query = "INSERT INTO bioContent (team, exec, header, content, info)
        VALUES (:tid, :exec, :hd, :cnt, :info)";
      $tid = $_POST["team"];
      $ec = (isset($_POST["ec"])) ? 1 : 0;
      $info = $_POST["nickname"]."::".$_POST["hometown"]."::".$_POST["major"].
        "::".$_POST["phone"]."::".$_POST["email"];
      $params = [":tid" => $tid,
                  ":exec" => $ec,
                  ":hd" => $_POST["header"],
                  ":cnt" => $_POST["content"],
                  ":info" => $info];
      dbPerform($query, $params);
    }
  }
  header("Location: ../admin.php?edit=".$_GET["edit"]."&page=".$_GET["page"]);
?>