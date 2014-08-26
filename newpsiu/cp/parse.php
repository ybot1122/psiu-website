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
			} else if ($_GET["edit"] == "teams") {
				// member management - main
				if ($_GET["page"] == "main") {
					$teams = getTeamContent(["Ec", "Rush", "Social", "Philanthropy"], false); ?>
					<form method="POST" action="cp/update.php?edit=teams&page=<?= $_GET["page"]; ?>"
							enctype="multipart/form-data"> 
						<ul class="nav nav-tabs">
							<li class="active"><a href="#exec" data-toggle="tab">Exec</a></li>
							<li><a href="#rush" data-toggle="tab">Rush</a></li>
							<li><a href="#social" data-toggle="tab">Social</a></li>
							<li><a href="#philanthropy" data-toggle="tab">Philanthropy</a></li>
						</ul> 
						<div class="tab-content">
							<div class="tab-pane active" id="exec"> <?PHP
								memberFormRender(false, $teams["Ec"]); ?>
							</div>
							<div class="tab-pane" id="rush"> <?PHP
								memberFormRender(false, $teams["Rush"]); ?>
							</div>
							<div class="tab-pane" id="social"> <?PHP
								memberFormRender(false, $teams["Social"]); ?>
							</div>
							<div class="tab-pane" id="philanthropy"> <?PHP
								memberFormRender(false, $teams["Philanthropy"]); ?>
							</div>
						</div>
						<input type="submit" value="Submit!" />
					</form> <?PHP
					return;
				}
				// member management - add
				if($_GET["page"] == "add") {
					genAddMember();
					return;
				}
			} else if ($_GET["edit"] == "gallery") {
				// gallery management - main
				if ($_GET["page"] == "main") {
					$content = dbQuery("SELECT id, header, content FROM galleryContent", [], true);
					genGalleryMain($content);
					return;
				}
				// gallery management - add
				if ($_GET["page"] == "add") {
					genAddPhoto();
					return;
				}
			}
		} ?>
		<p>Welcome to the admin panel. The links are to the left.</p> 
		<p>PLEASE NOTE: sometimes you need to refresh the page to see if image uploads have 
				worked</p> <?PHP
	}

// helper function to generate gallery form
function genGalleryMain($content) { ?>
<form method="POST" action="cp/update.php?edit=<?= $_GET["edit"]; ?>&page=<?= $_GET["page"]; ?>"> <?PHP
foreach($content as $panel) { ?>
<div class="row">
<div class="col-md-3">
<img class="img-responsive img-rounded" src="layout/gallery/<?= $panel["id"]; ?>.png" />
<div class="delbox">
<span class="small">If this box is checked, this photo will be removed upon submit<br /></span>
<input name="<?= $panel["id"]; ?>-del" type="checkbox" />
</div>
</div>
<div class="col-md-9">
<fieldset>
<input name="<?= $panel["id"]; ?>-header" class="static-header" type="text" value="<?= $panel["header"]; ?>" />
<textarea name="<?= $panel["id"]; ?>-content" class="static-content"><?= $panel["content"]; ?></textarea>
</fieldset> 
</div>
</div> <?PHP
} ?>
<input type="submit" value="Submit!" />
</form> <?PHP
}

// helper function to generate the form for adding a new member
function genAddMember() { ?>
<form method="POST" action="cp/update.php?edit=teams&page=add"
enctype="multipart/form-data">
<input name="header" type="text" value="Member Name" class="team-header" />
<div class="row">
<div class="col-md-3">
<img class="img-responsive img-rounded" 
src="layout/bio/default.png" alt="thumbnail" />
<input name="img" class="team-upload" type="file">
<div class="infobox">
<span class="small">
<ul>
<li>1.3 mb limit</li>
<li>.png format only</li>
<li>exactly 300px wide, 200px tall</li>
<li>USE COMMON SENSE</li>
</ul>
</span>
</div>
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
<tr>
<td><input name="nickname" type="text" class="team-info" value="--" /></td>
<td><input name="hometown" type="text" class="team-info" value="--" /></td>
<td><input name="major" type="text" class="team-info" value="--" /></td>
<td><input name="phone" type="text" class="team-info" value="--" /></td>
<td><input name="email" type="text" class="team-info" value="--" /></td>
</tr>
</table>
<textarea name="content" class="team-bio">Summary/Bio</textarea>
</div>
</div>
<span class="small">select a team, then indicate if the member is also on EC</span><br />
<input type="radio" name="team" value="-1" checked>None
<input type="radio" name="team" value="0">Rush Team
<input type="radio" name="team" value="1">Social Team
<input type="radio" name="team" value="2">Philanthropy Team
<input type="checkbox" name="ec">EC Member?
<input type="submit" value="Add Member" />
</form> <?PHP
}