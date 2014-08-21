<?PHP
  /* Note to self:
    Aim to display errors such that the expected formatting is least broken
    (output whatever data is possible to output even if query fails)
  */
  
  // standard content: extracts header and content fields row from the table
  function genStandardContent($pagename, $offset, $showDate = true) {
    $pid = findPageId($pagename);
    if ($pid === false) { ?>
      <p>Setup Error! Page id not found.</p> <?PHP
      return;
    }

    $data = dbQuery("SELECT header, content, edited 
                      FROM standardContent 
                      WHERE pid = :pid
                      LIMIT 1 OFFSET :off", [":pid"=>$pid, ":off"=>$offset]);
    if ($data != null) { ?>
      <h2><?= htmlspecialchars_decode($data[0]); ?></h2>
      <div>
        <?= htmlspecialchars_decode($data[1]); ?>
        <?PHP if ($showDate == true): ?>
        <p>last updated: <?= htmlspecialchars_decode($data[2]); ?></p> 
        <?PHP endif; ?>
      </div> <?PHP
      return;
    } ?>
    <p>Database Error! Content not found in table.</p> <?PHP
  }

  // function bio content: extracts header, info, and content fields from table
  // $exec: true for including exec members, false for excluding exec 
  // $offset: 
  // $team: string specifying a team to filter by
  function genBio($exec, $offset, $team = false) { ?>
    <div class="row narrow"> <?PHP
    if ($team) {
      $tid = findTeamId($team);
      if ($tid === false) { ?>
        <div class="col-md-9 col-md-offset-3">
          Setup Error! Team id not found.
        </div></div> <?PHP
        return;
      }
      $data = dbQuery("SELECT header, info, content, edited, id
                        FROM bioContent 
                        WHERE team = :team AND exec = :ec 
                        LIMIT 1 OFFSET :off", [":team"=>$tid, ":ec"=>$exec, ":off"=>$offset]);
    } else {
      $data = dbQuery("SELECT header, info, content, edited, id
                        FROM bioContent 
                        WHERE exec = :ec 
                        LIMIT 1 OFFSET :off", [":ec"=>$exec, ":off"=>$offset]);
    }

    if ($data != null) { 
      $info = explode("::", $data["info"]); ?>
      <div class="col-md-3">
        <img class="img-responsive img-rounded" 
          src="layout/bio/<?= $data["id"]; ?>.png" alt="<?= $data["header"]; ?>" />
      </div>
      <div class="col-md-9">
        <h3><?= $data["header"] ?></h3>
        <table>
          <tr> <?PHP
      if (count($info) != 5) { ?>
        <td colspan="5">Content Error! Info for this bio is malformed.</td> <?PHP
      } else { ?>
        <td><?= $info[0]; ?></td>
        <td><?= $info[1]; ?></td>
        <td><?= $info[2]; ?></td>
        <td><?= $info[3]; ?></td>
        <td><?= $info[4]; ?></td> <?PHP
      } ?>
    </tr>
  </table>  
  <div>
    <?= $data["content"]; ?>
  </div></div></div> <?PHP
    } else { ?>
      <div class="col-md-9 col-md-offset-3">Database Error!</div></div> <?PHP
    }
  }

  // TODO: a picture collage generator
?>