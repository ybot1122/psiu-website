<?PHP
	include("lib/photos_func.php");
	include("lib/boilerplate.php");
	displayHeader("Photos");
	displayTopNav();
?>
			<div class="row narrow">
            	<div class="col-md-12">
                    <div id="carousel-photos" class="carousel slide" data-ride="carousel" data-interval="">
                      	<!-- Indicators -->
                      	<ol class="carousel-indicators">
                        	<?= createSelectors(); ?>
                     	</ol>
                      	<!-- Wrapper for slides -->
                      	<div class="carousel-inner">
            							<?= createItems(); ?>
                      	</div>
                      	<!-- Controls -->
                      	<a class="left carousel-control" href="#carousel-photos" data-slide="prev">
                        	<span class="glyphicon glyphicon-chevron-left"></span>
                      	</a>
                      	<a class="right carousel-control" href="#carousel-photos" data-slide="next">
                        	<span class="glyphicon glyphicon-chevron-right"></span>
                      	</a>
                    </div>                
                </div>
            </div>
<?PHP
	displayFooter();
?>