<?PHP
  /*
    contact_gen.php; some helper functions to produce the tabbed elements
  */

  function createTeam($team) {
    $id = findTeamId($team);
    if ($id === -1) {
      $query = "SELECT * FROM bioContent WHERE exec = 1";
      $params = [];
    } else {
      $query = "SELECT * FROM bioContent WHERE team = :tid";
      $params = [":tid" => $id];
    }
    $result = dbQuery($query, $params, true); ?>
    <ul class="nav nav-tabs"> <?PHP
      makeTabs($result); ?>
    </ul> <?PHP

  }

  // helper function to make tabs
  function makeTabs($data) {
    for ($i = 0; $i < count($data); $i++) { ?>
      <li>
        <a href="#<?= $data[$i]["id"]; ?>" data-toggle="tab"><?= $data[$i]["header"]; ?></a>
      </li> <?PHP
    }
  }

  // helper function to make content
  function makePanes($data) {
    for ($i = 0; $i < count($data); $i++) { 
      $info = explode("::", $data["info"]); ?>
      <div class="tab-pane active" id="<?= $data[$i]["id"]; ?>">
        <div class="row narrow">
          <div class="col-md-9 col-md-offset-3"> <?PHP
    }
  }
?>