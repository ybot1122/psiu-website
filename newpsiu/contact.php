<?PHP
	include("lib/boilerplate.php");
	include("lib/contact_func.php");
	displayHeader("Contact");
	displayTopNav();
?>
            <!-- RUSH TEAM -->
			<div class="row narrow">
            	<div class="col-md-12">
                	<?= displayIntro(); ?>
                </div>
            </div>
            <div class="row narrow">
                <div class="col-md-12">
                    <h3>Rush Team <?= date('Y'); ?></h3>
                    <?= makeTabs(1); ?>
				</div>
            </div>
            <!-- SOCIAL TEAM -->
            <div class="row narrow">
                <div class="col-md-12">
                    <h3>Social Team <?= date('Y'); ?></h3>
                    <?= makeTabs(2); ?>
				</div>
            </div>
            <!-- PHILANTHROPY TEAM -->
            <div class="row narrow">
                <div class="col-md-12">
                    <h3>Philanthropy Team <?= date('Y'); ?></h3>
                    <?= makeTabs(3); ?>
				</div>
            </div>
<?PHP
	displayFooter();
?>