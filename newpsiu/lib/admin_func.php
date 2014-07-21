<?PHP
# This is a monster file, is going to build forms for each page based on its needs!

// Draw forms for the HOME page
function createHomeForms() {
	$result = sqlFetchAll("SELECT * FROM Home");
	if ($result != NULL) {
?>
<form role="form" method="post" action="lib/update.php?src=Home">
    <h4>Main Heading <small>You can edit the heading and the content</small></h4>
    <input type="text" name="header_1" class="form-control" value="<?= $result[0]["header"]; ?>" />
    <textarea name="content_1" class="form-control"><?= $result[0]["content"]; ?></textarea>
    <h4>Recent News <small>The featured Facebook post. Copy and paste from the "embed post" link in Facebook</small></h4>
    <input type="text" name="header_2" class="form-control" value="<?= $result[1]["header"]; ?>" disabled />
    <label for="FacebookData">Copy and paste the embed info from Facebook into here</label>
    <textarea id="FacebookData" name="content_2" class="form-control"><?= $result[1]["content"]; ?></textarea>
    <h4>Random Thing <small>Put whatever you want here</small></h4>
    <input type="text" name="header_3" class="form-control" value="<?= $result[2]["header"]; ?>" />
    <textarea name="content_3" class="form-control"><?= $result[2]["content"]; ?></textarea>
    <button type="submit" class="btn btn-default">Submit</button>
</form>                
<?PHP
	} else {
		echo("something is wrong if you see this message");
	}
}

// Create the forms for the VALUES page (Stored as About in database)
function createValuesForms() {
	$result = sqlFetchAll("SELECT * FROM About");
	if ($result != NULL) {
?>
<form role="form" method="post" action="lib/update.php?src=Values">
    <h4>Things We Do <small>Include a description/list of our major events</small></h4>
    <input type="text" name="header_1" class="form-control" value="<?= $result[0]["header"]; ?>" />
    <textarea name="content_1" class="form-control"><?= $result[0]["content"]; ?></textarea>
    <h4>Mission Statement <small>Copied/pasted from national website</small></h4>
    <input type="text" name="header_2" class="form-control" value="<?= $result[1]["header"]; ?>" />
    <textarea name="content_2" class="form-control"><?= $result[1]["content"]; ?></textarea>
    <h4>Member Benefits <small>Copied/pasted from national website</small></h4>
    <input type="text" name="header_3" class="form-control" value="<?= $result[2]["header"]; ?>" />
    <textarea name="content_3" class="form-control"><?= $result[2]["content"]; ?></textarea>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?PHP
	}
}

// Create the forms for the OFFICERS page
function createOfficersForms() {
	$result = sqlFetchAll("SELECT * FROM Officers");
	if ($result != NULL) {
		
?>
<form role="form" method="post" action="lib/update.php?src=Officers">
	<h4>Intro Paragraph <small>A little explanation about officers and what they are</small></h4>
    <input type="text" name="intro_header" class="form-control" value="<?= $result[0]["header"]; ?>" />
    <textarea name="intro_content" class="form-control"><?= $result[0]["content"]; ?></textarea>
<?PHP
		// Iterate through this array to produce forms for each officer
		for ($i = 1; $i <= 11; $i++) {
?>
	<div class="row narrow officer-control">
    	<div class="col-md-3 officer-upload">
        	<img src="layout/officers/<?= $i; ?>.png" alt="<?= $result[$i]["header"]; ?>" class="img-responsive img-rounded" />
        	<span class="help-block form-help">Must upload a 300x200 .png file</span>
        	<input type="file" disabled />
        </div>
    	<div class="col-md-9">
    		<input type="text" name="<?= $i; ?>_header" class="form-control" value="<?= $result[$i]["header"]; ?>" />
            <textarea name="<?= $i; ?>_content" class="form-control"><?= $result[$i]["content"]; ?></textarea>
        </div>
    </div>
<?PHP
		}
	}
?>
   	<button type="submit" class="btn btn-default">Submit</button>
</form>
<?PHP
}

// Create the forms for the CONTACT page
function createContactForms() {
	$intro = sqlPerform("SELECT * FROM Contact WHERE team = 0");
	$rush = sqlFetchAll("SELECT * FROM Contact WHERE team = 1");
	$social = sqlFetchAll("SELECT * FROM Contact WHERE team = 2");
	$philanthropy = sqlFetchAll("SELECT * FROM Contact WHERE team = 3");
?>
<form role="form" method="post" action="lib/update.php?src=Contact">
	<h4>Experience Greek <small>A little tidbit to convince kids to rush, and contact the rush team</small></h4>
    <input type="text" name="intro_header" class="form-control" value="<?= $intro["header"]; ?>" />
    <textarea name="intro_content" class="form-control"><?= $intro["content"]; ?></textarea>
    <h4>Rush Team 2014</h4>
    <div id="rush">
<?PHP
	loopThroughTeam($rush);
?>
		<a href="javascript:;" id="addRush">Add a new person to rush team</a> <span class="text-warning">(coming soon)</span>
    </div>
    <div id="social">
    	<h4>Social Team 2014</h4>
<?PHP
	loopThroughTeam($social);
?>
		<a href="javascript:;">Add a new person to social team</a> <span class="text-warning">(coming soon)</span>
    </div>
    <div id="philanthropy">
        <h4>Philanthropy Team 2014</h4>
<?PHP
	loopThroughTeam($philanthropy);
?>
        <a href="javascript:;">Add a new person to philanthropy team</a> <span class="text-warning">(coming soon)</span>
    </div>
   	<button type="submit" class="btn btn-default">Submit</button>
</form>
<?PHP
}

// HELPER FUNCTION FOR CONTACT FORMS
function loopThroughTeam($team) {
	foreach ($team as $a) {
?>
        <div class="row narrow officer-control">
            <div class="col-md-3 officer-upload">
                <img src="layout/contact/<?= $a["id"]; ?>.png" alt="<?= $a["header"]; ?>" class="img-responsive img-rounded" />
                <span class="help-block form-help">Must upload a 300x200 .png file</span>
                <input type="file" disabled />
                <p><a href="#">Remove this person</a> <span class="text-warning">(coming soon)</span></p>
            </div>
            <div class="col-md-9">
                <span class="help-block form-help">Full Name</span>
                <input type="text" name="<?= $a["id"]; ?>_header" class="form-control" value="<?= $a["header"]; ?>" />
<?PHP
		$info = explode("::", $a["info"]);
?>
                <span class="help-block form-help">Nickname</span>
                <input type="text" name="<?= $a["id"];?>_name" class="form-control" value="<?= $info[0]; ?>" />
                <span class="help-block form-help">Hometown</span>
                <input type="text" name="<?= $a["id"];?>_home" class="form-control" value="<?= $info[1]; ?>" />
                <span class="help-block form-help">Major</span>
                <input type="text" name="<?= $a["id"];?>_major" class="form-control" value="<?= $info[2]; ?>" />
                <span class="help-block form-help">Phone</span>
                <input type="text" name="<?= $a["id"];?>_phone" class="form-control" value="<?= $info[3]; ?>" />
                <span class="help-block form-help">Email</span>
                <input type="text" name="<?= $a["id"];?>_email" class="form-control" value="<?= $info[4]; ?>" />
                <span class="help-block form-help">Write a short bio about yourself</span>
                <textarea name="<?= $a["id"];?>_bio" class="form-control"><?= $a["bio"]; ?></textarea>
            </div>
        </div>
<?PHP
	}
}

// Create the forms for the CALENDAR page
function createCalendarForms() {
	$events = sqlFetchAll("SELECT * FROM Calendar");
	if ($events == NULL) {
		$events = array(array("title" => "New Event", "date" => "2014-1-1", "details" => "None", "id" => -1));
	} else {
		array_push($events, array("title" => "New Event", "date" => "2014-1-1", "details" => "None", "id" => -1));
	}
?>
		<p class="text-warning">Note: If event is set to an invalid date (i.e. Feb 31), that specific event will NOT UPDATE</p>
		<form role="form" method="post" action="lib/update.php?src=Calendar">
<?PHP
	foreach ($events as $a) {
		$month = date('n', strtotime($a["date"]));
		$day = date('j', strtotime($a["date"]));
?>
		<div class="row narrow">
        	<div class="col-md-6">
        		<span class="help-block form-help">Event Title</span>
				<input type="text" name="<?= $a["id"]; ?>_title" class="form-control" value="<?= $a["title"]; ?>" />
        		<span class="help-block form-help">Event Month</span>
        		<select class="form-control" name="<?= $a["id"]; ?>_month">
<?PHP
		for ($i = 1; $i <= 12; $i++) {
			if ($i != $month) {
?>
					<option value="<?= $i; ?>"><?= date('F', mktime(0,0,0,$i+1,0,0)) ?></option>
<?PHP
			} else {
?>
					<option value="<?= $i; ?>" selected="selected"><?= date('F', mktime(0,0,0,$i+1,0,0)) ?></option>
<?PHP
			}
		}
?>
                </select>
        		<span class="help-block form-help">Event Day</span>
                <select class="form-control" name="<?= $a["id"]; ?>_day">
<?PHP
		for ($i = 1; $i <= 31; $i++) {
			if ($i != $day) {
?>
					<option value="<?= $i; ?>"><?= $i; ?></option>
<?PHP
			} else {
?>
					<option value="<?= $i; ?>" selected="selected"><?= $i; ?></option>
<?PHP
			}
		}
?>
                </select>
        		<span class="help-block form-help">By default: you can only create events for current calendar year</span>
       			<?= date('Y'); ?>
            </div>
            <div class="col-md-6">
       			<span class="help-block form-help">Event Details</span>
        		<textarea name="<?= $a["id"]; ?>_details" class="form-control"><?= $a["details"]; ?></textarea>
<?PHP
		if ($a["id"] == -1) {
?>
        		<span class="help-block form-help">Uncheck box to allow this new event to be published</span>
        		<input type="checkbox" name="<?= $a["id"]; ?>_del" checked= />
<?PHP
		} else {
?>
        		<span class="help-block form-help">Check box to mark event for removal</span>
        		<input type="checkbox" name="<?= $a["id"]; ?>_del" />
<?PHP
		}
?>
            </div>
    	</div>
<?PHP
	}
?>
   		<button type="submit" class="btn btn-default">Submit</button>
	</form>
<?PHP
}
?>