<?PHP
  # BOILERPLATE FILE CONTAINS FUNCTIONS THAT CREATE HEADERS/FOOTERS, ETC
  # ALTERING HERE WILL ALTER ON ALL PAGES. BOILERPLATE HTML IS INTENDED
  # TO BE CONSISTENT ACROSS THE WEBSITE
    
  include("db.php");
  include("generators.php");
  session_start();
  
  // Write HTML Header Info
  // NOTE THIS FUNCTION DOES NOT CLOSE HEADER TAG. It is imperative that displayTopNav be called at
  // some point after displayHeader or else webpage will be malformed.
  function displayHeader($title) {
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Psi Upsilon at UW | <?= $title ?></title>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.custom.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?PHP
    }
  
  // Write HTML Footer Info
  // Default value is close, means they will close html tag for us.
  function displayFooter() {
?>
      <div class="row narrow footer">
        <div class="col-md-12">
          <p>&copy; Psi Upsilon (&Psi;&Upsilon;) 2014 
          | <a href="http://www.psiu.org/">Psi Upsilon Nationals</a> 
          | <a href="http://depts.washington.edu/greek/">UW Greeks</a> 
          | <a href="https://www.facebook.com/PsiUpsilon.UW">PsiU UW Facebook</a> 
          | <a href="http://getbootstrap.com/">Built With Bootstrap</a> 
          | <a href="http://students.washington.edu/psiu/contact.php">Contact Us</a> 
          | <?= displayMembers(); ?></p>
        </div>
      </div>
    </div>
  </body>
</html>
<?PHP
}
  
  // Write HTML for top Nav Bar
  function displayTopNav() {
?>
</head>
<body>
  <div class="container">
    <div class="row narrow">
      <div class="col-md-12">
        <div class="jumbotron header">
          <h1>Psi Upsilon (&Psi; &Upsilon;) Fraternity</h1>
          <h2><small>Theta Theta Chapter, University of Washington</small></h2>
        </div>
      </div>
    </div>
    <div class="row narrow">
      <div class="col-md-12">
        <ul class="nav nav-pills nav-justified nav-custom">
          <li><a href="index.php">Home</a></li>
          <li><a href="values.php">Values</a></li>
          <li><a href="officers.php">Officers</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="calendar.php">Calendar</a></li>
          <li><a href="photos.php">Photos</a></li>
          <li><a href="faq.php">FAQ</a></li>
        </ul>                
      </div>
    </div>
<?PHP
  }
  
  // HTML/Text for the Members Area/Logout Button
  function displayMembers() {
    if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
?>
<a href="login.php">Members Area</a> | <a href="login.php?logout=true">Logout</a>
<?PHP
    } else {
?>
<a href="login.php">Members Area</a>
<?PHP
    }
  }
?>