<?PHP
  include("lib/boilerplate.php");
  displayHeader("Officers");
  displayTopNav();

  for ($i = 0; $i <= 12; $i++) {
    genBio("Officers", $i);
  }

  displayFooter();
?>