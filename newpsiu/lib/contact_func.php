<?PHP
  # functions to build the content for contact cards

  // Makes the HTML tabs for a certain team (1 = rush, 2= social, 3 = philanthropy)
  // This includes the buttons and the actual tab content
  // The first tab is always set to active by default
  function makeTabs($team) {
    if ($team != 1 && $team != 2 && $team != 3) {
      echo("error, contact admin.");
      exit();
    }
    $results = sqlFetchAll("SELECT * FROM Contact WHERE team = " . $team);
    if ($results != NULL) {
      $num = count($results);
      // First write all the tabs
?>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
<?PHP
      for ($i = 0; $i < $num; $i++) {
        if ($i == 0) {
?>
  <li class="active">
<?PHP
        } else {
?>
  <li>
<?PHP
        }
?>
    <a href="#<?= $results[$i]["id"]; ?>" data-toggle="tab"><?= $results[$i]["header"]; ?></a>
  </li>
<?PHP
      }
?>
</ul>
<?PHP
      // Now write the div info
?>
<!-- Tab panes -->
<div class="tab-content rush-team">
<?PHP
      for ($i = 0; $i < $num; $i++) {
        if ($i == 0) {
?>
  <div class="tab-pane active" id="<?= $results[$i]["id"]; ?>">
<?PHP
        } else {
?>
  <div class="tab-pane" id="<?= $results[$i]["id"]; ?>">
<?PHP
        }
        $info = explode("::", $results[$i]["info"]);
?>
  <div class="row">
    <div class="col-md-4">
      <img src="layout/contact/<?= $results[$i]["id"]; ?>.png" alt="<?= $results[$i]["header"]; ?>" class="img-responsive img-rounded" />
    </div>
    <div class="col-md-3">
      <p>Nickname: <?= $info[0]; ?></p>
      <p>Hometown: <?= $info[1]; ?></p>
      <p>Major: <?= $info[2]; ?></p>
      <p>Phone: <?= $info[3]; ?></p>
      <p>Email: <?= $info[4]; ?></p>
    </div>
    <div class="col-md-4">
      <p><?= $results[$i]["bio"]; ?></p>
    </div>  
  </div>
</div>
<?PHP
    }
?>
</div>
<?PHP
    } else {
      echo("no contact info found");
    }
?>
<?PHP
  }

  // Call to display the intro paragraph
  function displayIntro() {
    $result = sqlPerform("SELECT header, content FROM Contact WHERE id = 1");
    if ($result != NULL) {
?>
<h3><?= $result["header"] ?></h3>
<p><?= $result["content"] ?></p>
<?PHP 
    } else {
      echo("error loading content, please contact admin");
    }
  }
?>