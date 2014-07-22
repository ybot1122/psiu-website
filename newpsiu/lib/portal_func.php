<?PHP
  $message = "Admin Access Required";
  if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
    if (isset($_GET["logout"])&& $_GET["logout"] == "true") {
      session_unset();
      session_destroy();
      $message = "You have logged out";
    } else {
      header("Location: admin.php");
    }
  }
  if (isset($_POST["user"]) && isset($_POST["pass"])) {
    if ($_POST["user"] == "USER" && $_POST["pass"] == "PASSWORD") {
      $_SESSION["logged"] = true;
      header("Location: admin.php");
    } else {
      $message = "Invalid Login";
    }
  }
?>