<?PHP
  // Call this method to display the info for an officer
  function displayOfficer($id) {
    $result = sqlPerform("SELECT header, content FROM Officers WHERE id = ".$id);
    if ($result != NULL) {
?>
<h3><?= $result["header"]; ?></h3>
<p><?= $result["content"]; ?></p>
<?PHP
    } else {
      echo("ERROR. CONTACT ADMIN");
    }
  }
?>