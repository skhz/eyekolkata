<?php
include_once('config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Winfred Admin</title>

<!-- Libraries -->
<link type="text/css" href="styles/layout.css" rel="stylesheet" />	

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/hoverIntent.js"></script>

<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!-- End of Libraries -->


<!-- Beginning of main menu-->
<link href="styles/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="styles/dropdown/themes/adobe.com/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>

<script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
<![endif]-->
<!-- END of main menu --> 

</head>
	<body>
		<!-- Container -->
		<div id="container">
		
			<!-- Header -->

			<div id="header">
				
				<!-- Top -->
				<?php include_once(CONTENTS.'header.php'); ?>
				<!-- End of Top-->
			
				<!-- The Top Menu -->
				<?php include_once(CONTENTS.'top-menu.php'); ?>
				<!-- End of Top Menu" -->
				
				<!-- Common Search bar -->
				<?php include_once(CONTENTS.'common-search.php'); ?>
			  <!-- End ofCommon Search bar -->
			
			</div>
			<!-- End of Header -->
			
			<!-- Background wrapper -->
			<div id="bgwrap">
		
				<!-- Main Content -->

				<div id="content">
					<div id="main">
					<!--<h1>Welcome, <span>Winfred</span>!</h1>-->

					<div class="pad20">
					<!-- Big buttons -->
						<ul class="dash">
							<li>
								<a href="enquiry.php" title="List all enquiry" class="tooltip">
									<img src="images/icons/25_48x48.png" alt="" />
									<span>Enquiry Inbox</span>
                                </a>
                            </li>
                            <li>
								<a href="add-edit-cms-page.php" title="Add new CMS page" class="tooltip">
									<img src="images/icons/8_48x48.png" alt="" />
									<span>New Page?</span>
                                </a>
                            </li>
							<li>
								<a href="view-cms-pages.php" title="View all CMS pages" class="tooltip">
									<img src="images/icons/7_48x48.png" alt="" />
									<span>CMS Pages</span>
                                </a>
                            </li>
							<li>
								<a href="javascript:void(0);" title="Manage users and accounts" class="tooltip">
									<img src="images/icons/16_48x48.png" alt="" />
									<span>Account</span>
                                </a>
                            </li>
							<li>
								<a href="javascript:void(0);" title="Your site's statistics" class="tooltip">
									<img src="images/icons/4_48x48.png" alt="" />
									<span>Site Statistics</span>
                              	</a>
                            </li>
							
						</ul>
						<!-- End of Big buttons -->
					</div>
				
					<hr />
					<!-- Sortable Dialogs -->
					<h2>Last posted enquiry</h2>
					<div class="sort">
						<div class="box ui-widget ui-widget-content ui-corner-all portlet">
						<div class="portlet-header">Sortable 1</div>
							<div class="portlet-content">
								<p>This is a sortable dialog. Praesent augue urna, vehicula sed sollicitudin quis, dignissim nec est.</p>
							</div>
						</div>
					</div>
					<!-- End of Sortable Dialogs -->
                    <hr/>
					
							
					</div>
				</div>
				<!-- End of Main Content -->
				<div id="sidebar">
                <?php include_once(CONTENTS.'left-bar.php');?>
                </div>
				
				
			</div>

		  <!-- End of bgwrap -->
		</div>
		<!-- End of Container -->
		
		<!-- Footer -->
		<?php include_once(CONTENTS.'footer.php'); ?>
	<!-- End of Footer -->

	</body>
</html>