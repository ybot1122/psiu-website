<?PHP
  include("lib/boilerplate.php");
  include("lib/lock.php");
  include("cp/parse.php");
  include("cp/message.php");
  displayHeader("Admin Panel");
?>
<link rel="stylesheet" href="css/admin.css">
<?PHP
  displayTopNav();
?>
<div class="row">
  <div class="col-md-3">
    <ul>
      <li>
        <h4>Edit Static Content</h4>
        <ul>
          <li><a href="admin.php?edit=static&page=Home">Home</a></li>
          <li><a href="admin.php?edit=static&page=Values">Values</a></li>
          <li><a href="admin.php?edit=static&page=Officers">Officers</a></li>
          <li><a href="admin.php?edit=static&page=Contact">Contact</a></li>
          <li><a href="admin.php?edit=static&page=Calendar">Calendar</a></li>
          <li><a href="admin.php?edit=static&page=Photos">Photos</a></li>
          <li><a href="admin.php?edit=static&page=Faq">FAQ</a></li>
        </ul>
      </li>
      <li>
        <h4>Manage Events</h4>
        <ul>
          <li><a href="admin.php?edit=events&page=main">Update Events</a></li>
          <li><a href="admin.php?edit=events&page=add">Add New Event</a></li>
        </ul>
      </li>
      <li>
        <h4>Manage Team Members</h4>
        <ul>
          <li><a href="admin.php?edit=teams&page=main">Edit Current Members</a></li>
          <li><a href="admin.php?edit=teams&page=add">Add New Member</a></li>
        </ul>
      </li>
      <li>
        <h4>Photo Gallery</h4>
        <ul>
          <li><a href="admin.php?edit=gallery&page=main">Edit Current Photos</a></li>
          <li><a href="admin.php?edit=gallery&page=add">Add New Photo</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="col-md-9">
    <?= genTitle(); ?>
    <?= displayMessage(); ?>
    <?= genForm(); ?>
  </div>
</div>
<?PHP
  displayFooter();
?>