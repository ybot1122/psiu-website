<?PHP
	// lib/MyCalendar.php - the page that declares our calendar class,
	// aptly named MyCalendar

	/*
		MyCalendar is a 7 month calendar which displays the current month, the previous 3 months
		and the subsequent 3 months. Class API is divided into two purposes: DOM generation and
		database management.

			constructor()				=> 	upon instantiation, myCalendar() queries the database
											for all events within the 7 month range and stores the
											info in a private variable
			-- DOM --
			calendarTabsRender()		=> 	generates the HTML for the tab selectors for each of the
											7 months wrapped in a <ul class="nav-tabs"> element
			calendarCarouselRender()	=>	generates the HTML for tab content for each of the 7
											months. Each tab pane consists of an event carousel
	*/

	class MyCalendar {
		private $months;
		private $events;

		function __construct() {
			$this->events[3] = [];
			for ($i = 0; $i < 3; $i++) {
				$prev = strtotime("-".$i." months");
				$next = strtotime("+".$i." months");

				$this->events[strtolower(date('F', strtotime("-".$i." months")))] = [];
				$this->events[strtolower(date('F', strtotime("+".$i." months")))] = [];
			}
			$temp = dbQuery("SELECT * FROM calendarContent
					WHERE date BETWEEN NOW() - INTERVAL 4 MONTH AND NOW() + INTERVAL 4 MONTH
					ORDER BY date ASC", [], true);
			foreach($temp as $curr) {
				array_push($this->events[strtolower(date('F', strtotime($curr["date"])))], $curr);
			}
		}

		// creates a new <ul> block element with nav tabs
		function calendarTabsRender() { ?>
			<ul class="nav nav-tabs calendar-tabs"> <?PHP
			foreach($this->events as $curr) { ?>
				<li <?PHP if ($curr == $this->active) { ?> class="active" <?PHP } ?>>
					<a href="#<?= $curr; ?>" data-toggle="tab"><?= ucfirst($curr); ?></a>
				</li> <?PHP
			} ?>
			</ul> <?PHP
		}

		// creates a <div> of the "tab-content" class and populates it with one content
		// pane for each month of the year
		function calendarCarouselRender() { ?>
			<div class="tab-content"> <?PHP
			foreach($this->months as $curr) {
				$key = date('n', strtotime($curr));
				// create the outer carousel div for this month
				if ($curr == $this->active) { ?>
				<div id="<?= $curr; ?>" class="carousel slide tab-pane carousel-events active"
						data-ride="carousel" data-interval=""> <?PHP
				} else { ?>
				<div id="<?= $curr; ?>" class="carousel slide tab-pane carousel-events"
						data-ride="carousel" data-interval=""> <?PHP
				} ?>
					<ol id="event-selectors" class="carousel-indicators">
						<?= $this->renderCarouselSelectors($key); ?>
					</ol> 
					<div id="event-info" class="carousel-inner">
						<?= $this->renderCarouselContent($key); ?>
					</div>
				</div> <?PHP
			} ?>
			</div> <?PHP
		}

		// private helper function that creates a carousel's selectors
		private function renderCarouselSelectors($key) {
			$month = strtolower(date('F', mktime(0, 0, 0, $key, 10)));
			if (count($this->events[$key]) == 0) { ?>
				<li class="active" data-target="#<?= $month; ?>" data-slide-to="0">
					No Events!
				</li> <?PHP
			} else { ?>
				<li class="active" data-target="#<?= $month; ?>" data-slide-to="0">
					<?= $this->events[$key][0]["header"]; ?>
				</li> <?PHP
			}
			for ($i = 1; $i < count($this->events[$key]); $i++) { ?>
				<li data-target="#<?= $month; ?>" data-slide-to="<?= $i; ?>">
					<?= $this->events[$key][$i]["header"]; ?>
				</li> <?PHP
			}
		}

		// private helper function that creates a carousel's content panels
		private function renderCarouselContent($key) {
			$month = strtolower(date('F', mktime(0, 0, 0, $key, 10)));
			$data = $this->events[$key];
			if (count($data) == 0) { ?>
				<div class="item active event-details no-event">
					<p>Currently no events scheduled this month, check back or contact us!</p>
				</div> <?PHP
				return;
			}
			for ($i = 0; $i < count($data); $i++) { ?>
				<div class="item <?PHP if ($i == 0): ?>active<?PHP endif; ?> event-details">
					<table>
						<tr>
							<td><?= date("l, F j", strtotime($data[$i]["date"])); ?></td>
							<td><?= $data[$i]["header"]; ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<?= $data[$i]["content"]; ?>
							</td>
						</tr>
					</table>
				</div> <?PHP
			}
		}
	}
?>