<?php
include_once('config.php');
$enquiryArray = array();
$Enquiry = new Enquiry();
$enquiryArray = $Enquiry->enquiryArray();
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
					
					<h2>Last posted enquiry</h2>
					<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                        <thead>

                            <tr>
                            	<td width="20"></td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Date</td>
                                <td width="90" >&nbsp;</td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php 
							foreach($enquiryArray as $key => $val){
						?>    
                            <tr <?php if($flag == 1){ $flag =0; ?> class="odd" <?php }else{$flag = 1; } ?> >
                                <td><input type="image" id="<?php echo $key;?>" class="dialog_link" src="images/icons/detail.png" alt="View Live" /></a></td>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $val['email']; ?></td>
                                <td><?php echo $val['phone']; ?></td>
                                <td><?php echo $val['create_date']; ?></td>
                                <td>
                                	<input type="image" src="images/email.png" onclick="javascript:alert('Under construction..');" />
                                    <input type="image" class="delete" value="<?php echo $key;?>" src="images/icons/delete.png" alt="" />
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                        <div id="dialog" title="Enquire details..">
                        	<!--Enquiry details-->
                        </div>
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