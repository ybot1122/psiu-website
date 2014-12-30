<?PHP
  function appendMessage($string) {
    if (!isset($_SESSION["message"]) || empty($_SESSION["message"])) {
      $_SESSION["message"] = $string;
    } else {
      $_SESSION["message"] = $_SESSION["message"] . " | " . $string;
    }
  }

  function displayMessage() {
    if (isset($_SESSION["message"]) && !empty($_SESSION["message"])) { ?>
      <span id="notify">NOTIFICATIONS: </span>
      <span id="notification"><?= $_SESSION["message"]; ?></span> 
      <?PHP
      $_SESSION["message"] = "";
    }
  }
?>