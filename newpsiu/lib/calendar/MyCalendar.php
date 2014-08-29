<?PHP
	// lib/calendar/MyCalendar.php - the page that declares our calendar class,
	// aptly named MyCalendar

	/*
		MyCalendar class represents the DOM framework for our PHP events system. The client should
		declare an instance of this class, and then invoke its DOM-constructing functions when
		ready. 
	*/

	class MyCalendar {
		private $months = ["january", "february", "march", "april", "may", "june", "july",
				"august", "september", "october", "november", "december"];
		private $active = strtolower(date('F'));
		private $events;

		function __construct() {
			echo("making query");
			$events = ["1" => [], "2" => [], "3" => [], "4" => [], "5" => [], "6" => [], "7" => [], 
					"8" => [], "9" => [], "10" => [], "11" => [], "12" => []];
			$temp = dbQuery("SELECT * FROM calendarContent", [], true);
			foreach($temp as $curr) {
				array_push($events[date('n', strtotime($curr["date"]))], $curr);
			}
		}

		// creates a new <ul> block element with nav tabs
		function calendarTabsRender() { ?>
			<ul class="nav nav-tabs"> <?PHP
			foreach($months as $curr) { ?>
				<li <?PHP if ($curr == $active) { ?> class="active" <?PHP } ?>>
					<a href="#<?= $curr; ?>" data-toggle="tab"><?= ucfirst($curr); ?></a>
				</li> <?PHP
			} ?>
			</ul> <?PHP
		}

		// creates a <div> of the "tab-content" class and populates it with one content
		// pane for each month of the year
		function calendarCarouselRender() { ?>
			<div class="tab-content"> <?PHP
			foreach($months as $curr) {
				$key = date('n', strtotime($curr));
				// create the outer carousel div for this month
				if ($curr == $active) { ?>
				<div id="<?= $curr; ?>" class="carousel slide tab-pane carousel-events active"
						data-ride="carousel" data-interval=""> <?PHP
				} else { ?>
				<div id="<?= $curr; ?>" class="carousel slide tab-pane carousel-events"
						data-ride="carousel" data-interval=""> <?PHP
				} ?>
					<ol id="event-selectors" class="carousel-indicators">
						<?= renderCarouselSelectors($key); ?>
					</ol> 
					<div id="event-info" class="carousel-inner">
						<?= renderCarouselContent($key); ?>
					</div>
				</div> <?PHP
			} ?>
			</div> <?PHP
		}

		// private helper function that creates a carousel's selectors
		private function renderCarouselSelectors($key) {
			$month = strtolower(date('F', mktime(0, 0, 0, $key, 10)));
			if (count($events[$key]) == 0) { ?>
				<li class="active" data-target="#<?= $month; ?>" data-slide-to="0">
					No Events!
				</li> <?PHP
			} else { ?>
				<li class="active" data-target="#<?= $month; ?>" data-slide-to="0">
					<?= $events[$key][0]["header"]; ?>
				</li> <?PHP
			}
			for ($i = 1; $i < count($events[$key]); $i++) { ?>
				<li data-target="#<?= $month; ?>" data-slide-to="<?= $i; ?>">
					<?= $events[$key][$i]["header"]; ?>
				</li> <?PHP
			}
		}

		// private helper function that creates a carousel's content panels
		private function renderCarouselContent($key) {
			$month = strtolower(date('F', mktime(0, 0, 0, $key, 10)));
			$data = $events[$key];
			if (count($data) == 0) {
				$data = [[
					"header" 	=> 	"No Events!",
					"content" 	=> 	"check back later or contact us",
					"date"		=> 	"0-0-0"
				]];
			}
			for ($i = 0; $i < count($data); $i++) { ?>
				<div class="item <?PHP if ($i == 0): ?>active<?PHP endif; ?> event-details">
					<table>
						<tr>
							<td><?= $data[$i]["date"]; ?></td>
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

?>