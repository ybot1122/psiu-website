<?PHP
  /* Note to self:
    Aim to display errors such that the expected formatting is least broken
    (output whatever data is possible to output even if query fails)
  */
  
  // standard content: extracts header and content fields row from the table
  function genStandardContent($pagename, $offset, $showDate = true) {
    $pid = findPageId($pagename);
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
  // $exec: true for including exec members, false for excluding exec 
  // $offset: 
  // $team: string specifying a team to filter by
  function genBio($exec, $offset, $team = false) { ?>
    <div class="row narrow"> <?PHP
    if ($team) {
      $tid = findTeamId($team);
      if (!$tid) { ?>
        <div class="col-md-9 col-md-offset-12">
          Setup Error! Team id not found.
        </div></div> <?PHP
        return;
      }
      $data = dbQuery("SELECT header, info, content 
                        FROM bioContent 
                        WHERE team = :team AND exec = :ec 
                        LIMIT 1 OFFSET :off", [":team"=>$tid, ":ec"=>$exec, ":off"=>$offset]);
    } else {
      $data = dbQuery("SELECT header, info, content 
                        FROM bioContent 
                        WHERE exec = :ec 
                        LIMIT 1 OFFSET :off", [":ec"=>$exec, ":off"=>$offset]);
    }

    if ($data != null) { 
      $info = explode("::", $data["info"]); ?>
      <h3><?= $data["header"] ?></h3>
      <div class="col-md-3">
        <img src="images/bio/<?= $offset; ?>.jpg" alt="<?= $data["header"]; ?>" />
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
  <div><?= $data["content"]; ?></div></div></div> <?PHP
    } else { ?>
      <div class="col-md-9 col-md-offset-12">Database Error!</div></div> <?PHP
    }
  }

  // TODO: a picture collage generator
?>