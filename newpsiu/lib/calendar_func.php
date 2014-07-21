<?PHP
// Produces a bunch of collapsable buttons with event details
function eventButtons() {
	$events = sqlFetchAll("SELECT id, title, details, EXTRACT(MONTH FROM date) AS month, EXTRACT(DAY FROM date) as day
	FROM Calendar WHERE date >= subdate(CURDATE(), 1) ORDER BY date ASC");
	if ($events == NULL) {
		return;
	}
	foreach ($events as $e) {
		$date = date('M', mktime(0, 0, 0, $e["month"], 1))." ".$e["day"].", ".date('Y');
?>
<button type="button" class="btn btn-default btn-event btn-block" data-toggle="collapse" data-target="#<?= $e["id"]; ?>">
	<?= $e["title"]; ?>: <?= $date; ?>
</button>
<div id="<?= $e["id"]; ?>" class="collapse"><?= $e["details"]; ?></div>
<?PHP		
	}
}

// This function calls drawCalendarGrid once for every month
function drawYear() {
	for ($i = 1; $i <= 12; $i++) {
		drawCalendarGrid($i);
	}
}

// This function draws a calendar and automatically adds the numbers
function drawCalendarGrid($month) {
	$firstDay = date("N", mktime(0, 0, 0, $month, 1, date("Y"))) % 7;
	$numDays = cal_days_in_month(CAL_GREGORIAN, $month, date("Y"));
	$counter = 1;
	$eventcounter = 0;
	$events = sqlFetchAll("SELECT title, details, EXTRACT(MONTH FROM date) AS month, EXTRACT(DAY FROM date) as day
	FROM Calendar WHERE MONTH(date) = " . $month . " ORDER BY date ASC");
	# Define div
	if (date("n") == $month) {
?>
<div class="tab-pane active" id="<?= $month ?>">
<?PHP
	} else {
?>
<div class="tab-pane" id="<?= $month ?>">
<?PHP
	}
	# Draw row, col, and table
?>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered calendar">
                <tr>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
                <tr>
<?PHP
	# Draw the first row, starting the counter at the correct day
	for ($i = 0; $i < 7; $i++) {
?>
<?PHP
		if ($i >= $firstDay) {
?>
                    <td id="<?= $month."-".$counter ?>">
						<?= $counter; ?>
<?PHP
			while (sizeof($events) > $eventcounter
			&& $events[$eventcounter]["month"] == $month
			&& $events[$eventcounter]["day"] == $counter) {
?>
						<p><strong><?= $events[$eventcounter]["title"]; ?></strong> - <?= $events[$eventcounter]["details"]; ?></p>
<?PHP
				$eventcounter++;
			}
?>
                    </td>
<?PHP
			$counter++;
		} else {
?>
                    <td></td>
<?PHP
		}
	}
?>
                </tr>
<?PHP
	# Do row by row, keeping track of how many days we've done
	while ($counter < $numDays) {
?>
                <tr>
<?PHP
		for ($i = 0; $i < 7; $i++) {
			if ($counter <= $numDays) {
?>
                    <td class="<?= $month."-".$counter ?>">
						<?= $counter; ?>
<?PHP
			while (sizeof($events) > $eventcounter
			&& $events[$eventcounter]["month"] == $month
			&& $events[$eventcounter]["day"] == $counter) {
?>
						<p><strong><?= $events[$eventcounter]["title"]; ?></strong> - <?= $events[$eventcounter]["details"]; ?></p>
<?PHP
				$eventcounter++;
			}
?>
                    </td>
<?PHP
				$counter++;
			} else {
?>
                    <td></td>
<?PHP
			}
		}
?>
                </tr>
<?PHP
	}
?>
            </table>
        </div>
    </div>
</div>
<?PHP
}
?>