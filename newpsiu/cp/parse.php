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

      } else if ($_GET["edit"] == "static") {

      }
    } ?>
    <p>Welcome to the admin panel. The links are to the left.</p> <?PHP
  }

  // Helper function to do generation of static-content forms
  function genStatic($content) { ?>
    <form method="POST" action="#"> <?PHP
    foreach($content as $panel) { ?>
      <fieldset>
        <input id="<?= $panel["id"]; ?>-header" type="text" value="<?= $panel["header"]; ?>" />
        <textarea id="<?= $panel["id"]; ?>-content"><?= $panel["content"]; ?></textarea>
      </fieldset> <?PHP
    } ?>
      <input type="submit" value="Submit!" />
    </form> <?PHP
  }
?>