<?php
include_once('config.php');
$heading = 'Add';

if($_POST){
	if(!empty($_POST['ques']) && !empty($_POST['ans'])){
		extract($_POST);
		$FAQ = new FAQ($_POST['ques'], $_POST['ans'], (empty($_POST['is_active']) ? '0' : $_POST['is_active']), $_POST['faq_id']);
		if(empty($_POST['faq_id'])){
			$faq_id = $FAQ->addFAQ();
			if($faq_id > 0){
				$msg = '<div class="message success close">
							<h2>Congratulations!</h2>
							<p>One page is inserted with CMS ID : '.$faq_id.'</p>
						</div>';
				header('location:add-edit-faq.php');
			}else{
				$msg = '<div class="message error close">
							<h2>Error!</h2>
							<p>Page is not inserted, please try again!</p>
						</div>';
			}
		}else{
			if($FAQ->editFAQ()){
				$msg = '<div class="message success close">
							<h2>Congratulations!</h2>
							<p>One page is updated having CMS ID : '.$_POST['faq_id'].'</p>
						</div>';
				header('location:view-faq.php');
			}else{
				$msg = '<div class="message error close">
							<h2>Error!</h2>
							<p>Page is not updated, please try again!</p>
						</div>';
			}
		}
	}else{
	
	}
}elseif($_GET){
	if( is_numeric( $faq_id = base64_decode($_GET['faq_id'])) ){
		$FAQ = new FAQ();
		$FAQ->FAQRecord($faq_id);
		$heading = 'Edit';
	}
}else{

}
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
<!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js" language="javascript"></script>
<script type="text/javascript" src="js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        skin : "o2k7",
        skin_variant : "black",
        height : "200",
        extended_valid_elements : "iframe[width|height|frameborder|scrolling|marginheight|marginwidth|src]",
        //invalid_elements : "strong,b,em,i",
        language : "en",
        editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor",
        plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,spellchecker,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "cut,copy,paste,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,charmap,emotions,| pasteword,code",
        theme_advanced_buttons2 : "formatselect,|,fontselect,fontsizeselect",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_buttons5 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "center",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        content_css : "",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
        file_browser_callback : "tinyBrowser",
        document_base_url : "http://localhost/",

        // Replace values for the template plugin
        template_replace_values : {
            username : "\"",
            staffid : ""
        }
    });
</script>
<!-- /TinyMCE -->

<!-- End of Libraries -->

<!-- Beginning of main menu-->
<link href="styles/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="styles/dropdown/themes/adobe.com/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>

<script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
<![endif]-->
<!-- END of main menu -->


<!-- End of Libraries -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#submit').click(function(){
			var flag = true;
			if($('#ques').val() == ''){
				$('.ques').html('Question required!'); flag = false;
			}
			if(tinyMCE.get('ans').getContent()=="" || tinyMCE.get('ans').getContent()==null){
				$('.ans').html('Answear required!'); flag = false;
			}
			
			if(!flag){
				return false;
			}else{
				return true;
			}
		});
	});
</script>        
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
			<h2><span><?php echo $heading; ?> : </span>FAQ</h2>
            <?php echo $msg; unset($msg); ?>
            <form id="frmAddEditCMS" name="frmAddEditCMS" method="post" action="<?php echo PAGE_NAME; ?>">
                <input type="hidden" name="faq_id" id="faq_id" value="<?php echo $FAQ->faq_id; ?>"  />
                <!-- Fieldset -->
                <fieldset>
                    <legend>Head Content</legend>
                    <p><label for="mf">Page title: </label><input class="mf" name="ques" id="ques" type="text" value="<?php echo $FAQ->ques; ?>" maxlength="255" /> <span class="validate_error ques">&nbsp;</span></p>
                    <p><label for="lf">Page top description: </label><textarea class="mf mceEditor" name="ans" id="ans"  rows="4"><?php echo $FAQ->ans; ?></textarea><span class="validate_error ans">&nbsp;</span></p>
                	<p><label for="lf">Publish: </label><input type="checkbox" name="is_active" id="is_active" value="1" <?php if($FAQ->is_active == '1'){?> checked="checked" <?php }?>/></p>
                </fieldset>    
                    <p><input class="button" type="submit" id="submit" name="submit" value="<?php echo empty($FAQ->faq_id) ? 'Add FAQ' : 'Update FAQ'; ?>" />
                    
                    <input class="button" type="button" value="Cancel" onclick="javascript:window.location = 'view-faq.php'" /></p>
                <!-- End of fieldset -->
            </form>
				</div>
				</div>
				<!-- End of Main Content -->
				<!-- Sidebar -->
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