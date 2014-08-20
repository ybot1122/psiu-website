<?PHP
  // used to create the header for each admin page
  function genTitle() {
    global $pages; ?>
    <h3><a href="admin.php">Admin Panel</a> <?PHP
    if (isset($_GET["edit"]) && isset($_GET["page"])) {
      if ($_GET["edit"] == "static") {
        $pid = findPageId($_GET["page"]);
        if ($pid !== false) { ?>
          >> <?= $pages[$pid];?> Static Content</h3> <?PHP
          return;
        }
      } else if ($_GET["edit"] == "events") { ?>
        >> Manage Events</h3> <?PHP
        return;
      } else if ($_GET["edit"] == "teams") { ?>
        >> Manage Team Members</h3> <?PHP
        return;
      }else if ($_GET["edit"] == "gallery") { ?>
        >> Manage Photo Gallery</h3> <?PHP
      }
    } ?>
    </h3> <?PHP
  }

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
          // member management - main
          if ($_GET["page"] == "main") {
          $content = dbQuery("SELECT team, exec, header, content, info, id FROM bioContent
                              ORDER BY team ASC", [], true);
          $counts = dbQuery("SELECT COUNT(bioContent.id) AS num
                              FROM bioContent GROUP BY team ORDER BY team ASC", [], true); ?>
        <form method="POST" action="cp/update.php?edit=<?= $_GET["edit"]; ?>&page=<?= $_GET["page"]; ?>"
          enctype="multipart/form-data"> <?PHP
          genTeams($content, $counts); ?>
          <input type="submit" value="Submit!" />
        </form> <?PHP
          return;
        }
        // member management - add
        if($_GET["page"] == "add") {
          genAddMember();
          return;
        }
      } else if ($_GET["edit"] == "gallery") {
        // gallery management - main
        if ($_GET["page"] == "main") {
          $content = dbQuery("SELECT id, header, content FROM galleryContent", [], true);
          genGalleryMain($content);
          return;
        }
        // gallery management - add
        if ($_GET["page"] == "add") {
          genAddPhoto();
          return;
        }
      }
    } ?>
    <p>Welcome to the admin panel. The links are to the left.</p> 
    <p>PLEASE NOTE: sometimes you need to refresh the page to see if image uploads have worked</p> <?PHP
  }

  // Helper function to do generation of static-content forms
  function genStatic($content) { ?>
    <form method="POST" action="cp/update.php?edit=<?= $_GET["edit"]; ?>&page=<?= $_GET["page"]; ?>"> <?PHP
    foreach($content as $panel) { ?>
      <fieldset>
        <input name="<?= $panel["id"]; ?>-header" class="static-header" type="text" value="<?= $panel["header"]; ?>" />
        <textarea name="<?= $panel["id"]; ?>-content" class="static-content"><?= $panel["content"]; ?></textarea>
      </fieldset> <?PHP
    } ?>
      <input type="submit" value="Submit!" />
    </form> <?PHP
  }

  // helper function to generate gallery form
  function genGalleryMain($content) { ?>
    <form method="POST" action="cp/update.php?edit=<?= $_GET["edit"]; ?>&page=<?= $_GET["page"]; ?>"> <?PHP
    foreach($content as $panel) { ?>
      <div class="row">
        <div class="col-md-3">
          <img class="img-responsive img-rounded" src="layout/gallery/<?= $panel["id"]; ?>.png" />
          <div class="delbox">
            <span class="small">If this box is checked, this photo will be removed upon submit<br /></span>
            <input name="<?= $panel["id"]; ?>-del" type="checkbox" />
          </div>
        </div>
        <div class="col-md-9">
          <fieldset>
            <input name="<?= $panel["id"]; ?>-header" class="static-header" type="text" value="<?= $panel["header"]; ?>" />
            <textarea name="<?= $panel["id"]; ?>-content" class="static-content"><?= $panel["content"]; ?></textarea>
          </fieldset> 
        </div>
      </div> <?PHP
    } ?>
    <input type="submit" value="Submit!" />
    </form> <?PHP
  }

  // Helper function to generate team-management forms
  // Really stupidly implemented i'm not sure how I got myself into this one lol...
  function genTeams($content, $counts) {
    $fields = ["nickname", "hometown", "major", "phone", "email"];
    for ($i = 0; $i < count($content); $i++) {
      // pick header then generate content
      if ($i == 0) { ?>
        <h3>Exec Team</h3><fieldset> <?PHP 
      } else if ($i == $counts[0]["num"]) { ?>
        </fieldset><h3>Rush Team</h3><fieldset> <?PHP
      } else if ($i == $counts[0]["num"] + $counts[1]["num"]) { ?>
        </fieldset><h3>Social Team</h3><fieldset> <?PHP
      } else if ($i == $counts[0]["num"] + $counts[1]["num"] + $counts[2]["num"]) { ?>
        </fieldset><h3>Philanthropy Team</h3><fieldset> <?PHP
      } ?>
      <input name="<?= $content[$i]["id"]; ?>-header" type="text" class="team-header"
        value="<?= $content[$i]["header"]; ?>" />
      <div class="row">
        <div class="col-md-3">
          <img class="img-responsive img-rounded" 
            src="layout/bio/<?= $content[$i]["id"]; ?>.png" alt="<?= $content[$i]["header"]; ?>" />
          <input name="<?= $content[$i]["id"]; ?>-img" class="team-upload" type="file">
          <div class="infobox">
            <span class="small">
              <ul>
                <li>1.3 mb limit</li>
                <li>.png format only</li>
                <li>exactly 300px wide, 200px tall</li>
                <li>USE COMMON SENSE</li>
              </ul>
            </span>
          </div>
        </div>
        <div class="col-md-9">
      <table>
        <tr> <?PHP
      foreach($fields as $f) { ?>
        <th><?= ucfirst($f); ?></th> <?PHP
      } ?>
        </tr>
        <tr> <?PHP
      $info = explode("::", $content[$i]["info"]);
      for($j = 0; $j < 5; $j++) { 
        if ($j >= count($info) || empty($info[$j])) { ?>
          <td><input name="<?= $content[$i]["id"]."-".$fields[$j]; ?>" class="team-info"
            type="text" value="<?= $fields[$j] ?>" /></td> <?PHP
        } else { ?> 
          <td><input name="<?= $content[$i]["id"]."-".$fields[$j]; ?>" class="team-info"
            type="text" value="<?= $info[$j]; ?>" /></td> <?PHP
        }
      } ?>
        </tr>
      </table>
      <textarea name="<?= $content[$i]["id"]; ?>-content" 
        class="team-bio"><?= $content[$i]["content"]; ?></textarea>
      <div class="delbox">
        <span class="small">If this box is checked, this profile will be removed upon submit<br /></span>
        <input name="<?= $content[$i]["id"]; ?>-del" type="checkbox" />
      </div>
        </div></div><?PHP
    } ?>
    </fieldset> <?PHP
  }

  // helper function to generate the form for adding a new member
  function genAddMember() { ?>
    <form method="POST" action="cp/update.php?edit=teams&page=add"
      enctype="multipart/form-data">
      <input name="header" type="text" value="Member Name" class="team-header" />
      <div class="row">
        <div class="col-md-3">
          <img class="img-responsive img-rounded" 
            src="layout/bio/default.png" alt="thumbnail" />
          <input name="img" class="team-upload" type="file">
          <div class="infobox">
            <span class="small">
              <ul>
                <li>1.3 mb limit</li>
                <li>.png format only</li>
                <li>exactly 300px wide, 200px tall</li>
                <li>USE COMMON SENSE</li>
              </ul>
            </span>
          </div>
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
              <td><input name="nickname" type="text" class="team-info" value="--" /></td>
              <td><input name="hometown" type="text" class="team-info" value="--" /></td>
              <td><input name="major" type="text" class="team-info" value="--" /></td>
              <td><input name="phone" type="text" class="team-info" value="--" /></td>
              <td><input name="email" type="text" class="team-info" value="--" /></td>
            </tr>
          </table>
          <textarea name="content" class="team-bio">Summary/Bio</textarea>
        </div>
      </div>
      <span class="small">select a team, then indicate if the member is also on EC</span><br />
      <input type="radio" name="team" value="-1" checked>None
      <input type="radio" name="team" value="0">Rush Team
      <input type="radio" name="team" value="1">Social Team
      <input type="radio" name="team" value="2">Philanthropy Team
      <input type="checkbox" name="ec">EC Member?
      <input type="submit" value="Add Member" />
    </form> <?PHP
  }

  // helper function to generate a form for uploading a new gallery image
  function genAddPhoto() { ?>
    <form method="POST" action="cp/update.php?edit=gallery&page=add" enctype="multipart/form-data">
      <table>
        <tr>
          <td class="formLabel">Photo Title:</td>
          <td><input name="header" type="text" class="team-header" /></td>
        </tr>
        <tr>
          <td class="formLabel">Photo Description:</td>
          <td><input name="content" type="text" class="team-header" /></td>
        </tr>
        <tr>
          <td class="formLabel">Image Upload (jpg, jpeg, png allowed):</td>
          <td>
            <input name="img" class="team-upload" type="file" />
            <div class="infobox">
              <span class="small">
                <ul>
                  <li>1.3 mb limit</li>
                  <li>.png format only</li>
                  <li>well be stretched to 500px width</li>
                  <li>USE COMMON SENSE ON WHAT YOU UPLOAD</li>
                </ul>
              </span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" value="Upload To Photo Gallery" /></td>
        </tr>
      </table>
    </form> <?PHP
  }
?>