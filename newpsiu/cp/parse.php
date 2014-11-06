<?PHP
	// used to create the header for each admin page
	function genTitle() {
		global $pages; ?>
		<h3><a href="admin.php">Admin Panel</a> <?PHP
		if (isset($_GET["edit"]) && isset($_GET["page"])) {
			if ($_GET["edit"] == "static") {
				$pid = findPageId($_GET["page"]);
				if ($pid !== false) { ?>
					>> <?= $pages[$pid];?> Static Content</h3> <?PHP
					return;
				}
			} else if ($_GET["edit"] == "events") { ?>
				>> Manage Events</h3> <?PHP
				return;
			} else if ($_GET["edit"] == "teams") { ?>
				>> Manage Team Members</h3> <?PHP
				return;
			} else if ($_GET["edit"] == "gallery") { ?>
				>> Manage Photo Gallery</h3> <?PHP
			}
		} ?>
		</h3> <?PHP
	}

	// Parses the get variables and calls the appropriate function to generate our forms
	function genForm() {
		if (isset($_GET["edit"]) && isset($_GET["page"])) {
			// static content
			if ($_GET["edit"] == "static") {
				include("templates/forms.php");
				$pid = findPageId($_GET["page"]);
				if ($pid !== false) {
					$content = dbQuery("SELECT header, content, id FROM standardContent 
												WHERE pid = :pid", [":pid"=>$pid], true);
					if ($content == null) { ?>
						<p>Database Error.</p> <?PHP
					} else {
						staticContentFormRender($content);
					}
					return;
				}
			} else if ($_GET["edit"] == "events") {
				include("templates/events.php");
				$today = date("Y/m/d");
				$data = getEvents($today);
				activeEventFormRender($data);
				addEventFormRender();
				return;
			} else if ($_GET["edit"] == "teams") {
				include("templates/members.php");
				// member management - main
				if ($_GET["page"] == "main") {
					$teams = getTeamContent(["Ec", "Rush", "Social", "Philanthropy"], false); ?>
					<form method="POST" action="cp/update.php?edit=teams&page=main"
							enctype="multipart/form-data">
						<?= tabbedMemberFormRender($teams); ?>
						<input type="submit" value="Submit!" />
					</form> <?PHP
					return;
				}
				// member management - add
				if($_GET["page"] == "add") { ?>
					<form method="POST" action="cp/update.php?edit=teams&page=add"
							enctype="multipart/form-data"> <?PHP
						memberFormRender(true, null); ?>
						<input type="submit" value="Submit!" />
					</form> <?PHP
					return;
				}
			} else if ($_GET["edit"] == "gallery") {
				include("templates/gallery.php");
				// gallery management - main
				if ($_GET["page"] == "main") {
					$content = getGalleryContent();
					galleryEditFormRender($content);
					return;
				}
				// gallery management - add
				if ($_GET["page"] == "add") {
					photoAddFormRender();
					return;
				}
			}
		} ?>
		<p>Welcome to the admin panel. The links are to the left.</p> 
		<p>PLEASE NOTE: sometimes you need to refresh the page to see if image uploads have 
				worked</p> <?PHP
	}
?>