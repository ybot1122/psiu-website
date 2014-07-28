<?PHP
  // Parses the get variables and calls the appropriate function to generate our forms
  function genForm() {
    if (isset($_GET["edit"]) && isset($_GET["page"])) {
      if ($_GET["edit"] == "static") {
        $pid = findPageId($_GET["page"]);
        if ($pid !== false) {
          $content = dbQuery("SELECT header, content, id FROM standardContent 
                              WHERE pid = :pid", [":pid"=>$pid], true);
          if ($content == null) { ?>
            <p>Database Error.</p> <?PHP
          }
          genStatic($content);
          return;
        }
      } else if ($_GET["edit"] == "events") {
      } else if ($_GET["edit"] == "teams") {
        $content = dbQuery("SELECT team, exec, header, content, info FROM bioContent
                            ORDER BY team ASC", [], true);
        $counts = dbQuery("SELECT COUNT(bioContent.id) AS num
                            FROM bioContent GROUP BY team ORDER BY team ASC", [], true);
        genTeams($content, $counts);
        return;
      }
    } ?>
    <p>Welcome to the admin panel. The links are to the left.</p> <?PHP
  }

  // Helper function to do generation of static-content forms
  function genStatic($content) { ?>
    <form method="POST" action="cp/update.php?edit=<?= $_GET["edit"]; ?>&page=<?= $_GET["page"]; ?>"> <?PHP
    foreach($content as $panel) { ?>
      <fieldset>
        <input name="<?= $panel["id"]; ?>-header" type="text" value="<?= $panel["header"]; ?>" />
        <textarea name="<?= $panel["id"]; ?>-content"><?= $panel["content"]; ?></textarea>
      </fieldset> <?PHP
    } ?>
      <input type="submit" value="Submit!" />
    </form> <?PHP
  }

  // Helper function to generate team-management forms
  function genTeams($content, $counts) {
    for($i = 0; $i < $counts[0]["num"]; $i++)
    $teams = ["Exec-Only"=>0,
              "Rush"=>$counts[0]["num"],
              "Social"=>$counts[0]["num"] + $counts[1]["num"],
              "Philanthropy"=>$counts[0]["num"] + $counts[1]["num"] + $counts[2]["num"]];
    for($i = 0; $i < count($content); $i++) {
      $hd = array_search($i, $teams);
      if ($hd !== false) { ?>
        <h3><?= $hd; ?></h3> <?PHP
      } ?>
      <fieldset>
        <input type="text" value="<?= $content[$i]["header"]; ?>" />
        <textarea><?= $content[$i]["content"]; ?></textarea> <?PHP
        $info = explode("::", $teams[$i]["info"]);
        for($j = 0; $j < 5; $j++) { 
          if ($j >= count($info)) { ?>
            <input type="text" value="--" /> <?PHP
          } else { ?> 
            <input type="text" value="<?= $info[$j]; ?>" /> <?PHP
          }
        } ?>
        </fieldset> <?PHP
    }
  }
?>