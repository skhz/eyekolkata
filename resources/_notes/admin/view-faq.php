<?php
include_once('config.php');
$faqArray = array();
$FAQ = new FAQ();
$faqArray = $FAQ->FAQArray();
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

<!-- Beginning of main menu-->
<link href="styles/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="styles/dropdown/themes/adobe.com/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>

<script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
<![endif]-->
<!-- END of main menu --> 

<!-- End of Libraries -->
      
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
                    
					<h2>List of all FAQs</h2>
                        <?php 
						if(!empty($faqArray)){	
							foreach($faqArray as $key => $val){
						?>    
                            
                            <div class="sort">
                                <div class="box ui-widget ui-widget-content ui-corner-all portlet">
                                <div class="portlet-header">
                                        <input class="button" type="submit" id="submit" name="submit" value="Edit" onclick="javascript: window.location = 'add-edit-faq.php?faq_id=<?php echo base64_encode($key); ?>'" />
                                        <input class="button" type="submit" id="submit" name="submit" value="Delete" onclick="javascript: if(confirm('Are you sure you want to delete this FAQ?')){ window.location = 'add-edit-faq.php'}" />
										<?php echo $faqArray[$key]['ques']; ?>
                                </div>
                                <div class="portlet-content">
                                    <div style="margin-left:10px;"><?php echo $faqArray[$key]['ans']; ?></div>
                                    
                                </div>
                            </div>
                            </div>
                        <?php }
						}else{?>
                        <p>No FAQs are found.</p>
                    	<?php }?>
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