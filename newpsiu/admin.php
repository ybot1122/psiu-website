<?PHP 
	include("lib/boilerplate.php");
	include("lib/lock.php");
	include("lib/admin_func.php");
	displayHeader("Admin");
?>
			<!-- <script src="js/addMember.js" type="application/javascript"></script> -->
<?PHP
	displayTopNav();
?>
			<div class="row">
            	<div class="col-md-12">
                	<h3>Admin Panel</h3>
                    <ul>
                      <li>Self explanatory, but <strong>ANYONE</strong> logged into the admin account can <strong>edit ANYTHING</strong>.</li>
                      <li>You should ONLY type <strong>PLAIN TEXT ONLY</strong> into the textareas. Please do not try to type HTML or web language into the textarea - this is a known vulnerability that will be addressed down the road.</li>
                      <li>Pressing Submit will only submit updates for the corresponding page. <span class="text-danger"><strong>Pressing submit DOES NOT submit ALL changes</strong></span>.</li>
                      <li>Image uploads not functional yet</li>
                      <li>Editing for some pages are currently disabled because they are implemented with "temporary" solutions (meaning they're still WIPs).</li>
                    </ul>
                </div>
            </div>
			<div class="row">
            	<div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                    	<li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                      	<li><a href="#values" data-toggle="tab">Values</a></li>
                      	<li><a href="#officers" data-toggle="tab">Officers</a></li>
                      	<li><a href="#contact" data-toggle="tab">Contact</a></li>
                  	    <li><a href="#calendar" data-toggle="tab">Calendar</a></li>
                   	   	<li><a href="#photos" data-toggle="tab">Photos</a></li>
                   	   	<li><a href="#faq" data-toggle="tab">FAQ</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                  	    <div class="tab-pane active admin-pane" id="home">
                            <h3>Home</h3>
                            <div class="admin-form">
                                <p>Temporarily Disabled.</p>
                            </div>
                        </div>
                  	    <div class="tab-pane admin-pane" id="values">
                            <h3>Values</h3>
                            <div class="admin-form">
                                <p>Temporarily Disabled.</p>
                            </div>
                        </div>
                  	    <div class="tab-pane admin-pane" id="officers">
                            <h3>Officers</h3>
                        		<div class="admin-form">
                        			<?= createOfficersForms(); ?>
                       			</div>
                        </div>
                  	    <div class="tab-pane admin-pane" id="contact">
                            <h3>Contact</h3>
                            <div class="admin-form">
                                <?= createContactForms(); ?>
                            </div>
                        </div>
                  	    <div class="tab-pane admin-pane" id="calendar">
                            <h3>Calendar</h3>
                            <div class="admin-form">
                                <?= createCalendarForms(); ?>
                            </div>
                        </div>
                  	    <div class="tab-pane admin-pane" id="photos">
                            <h3>Photos</h3>
                            <div class="admin-form">
                                <p>Temporarily Disabled.</p>
                            </div>
                        </div>
                  	    <div class="tab-pane admin-pane" id="faq">
                            <h3>FAQ</h3>
                            <div class="admin-form">
                                <p>Temporarily Disabled.</p>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
<?PHP
	displayFooter();
?>