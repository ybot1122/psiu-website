<?PHP
	// Creates all the buttons and collapsable divs for the FAQ section
	function makeFAQ() {
		$results = sqlFetchAll("SELECT * FROM Faq");
		if ($results != NULL) {
			foreach($results as $q) {
?>
<button type="button" class="btn btn-default btn-faq" data-toggle="collapse" data-target="#<?= $q["id"]; ?>"><?= $q["header"]; ?></button>
<div class="collapse collapse-faq" id="<?= $q["id"]; ?>">
	<?= $q["content"]; ?>
</div>
<?PHP
			}
		} else {
			echo("no data found");
		}
	}
?>