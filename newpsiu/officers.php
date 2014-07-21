<?PHP 
	include("lib/boilerplate.php");
	include("lib/officers_func.php");
	displayHeader("Officers");
	displayTopNav();
?>
			<div class="row">
            	<div class="col-md-12">
					<?= displayOfficer(1); ?>
                </div>
            </div>
			<!-- pres -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/1.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(2); ?>
                </div>
            </div>
            <!-- treasurer -->
			<div class="row officers">
               <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/2.png" alt="Officer" />
                </div>
             	<div class="col-md-8">
					<?= displayOfficer(3); ?>
                </div>
            </div>
            <!-- rush chair -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/3.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(4); ?>
                </div>
            </div>
            <!-- house man -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/4.png" alt="Officer" />
                </div>
             	<div class="col-md-8">
					<?= displayOfficer(5); ?>
                </div>
            </div>
            <!-- new members -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/5.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(6); ?>
                </div>
            </div>
            <!-- vppa -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/6.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(7); ?>
                </div>
            </div>
            <!-- risk -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/7.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(8); ?>
                </div>
            </div>
            <!-- social -->
			<div class="row officers">
               <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/8.png" alt="Officer" />
                </div>
             	<div class="col-md-8">
					<?= displayOfficer(9); ?>
                </div>
            </div>
            <!-- dance -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/9.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(10); ?>
                </div>
            </div>
            <!-- scholar -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/10.png" alt="Officer" />
                </div>
             	<div class="col-md-8">
					<?= displayOfficer(11); ?>
                </div>
            </div>
            <!-- kitchen -->
			<div class="row officers">
                <div class="col-md-3">
                	<img class="img-responsive img-rounded" src="layout/officers/11.png" alt="Officer" />
                </div>
            	<div class="col-md-8">
					<?= displayOfficer(12); ?>
                </div>
            </div>
<?PHP
	displayFooter();
?>