<?php include_once('includes/config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo $page_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="Page-Enter" content="blendTrans(Duration=4.0)">
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="stylesheet" href="styles/haccordion.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery.slidepanel.setup.js"></script>
    
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/scrolltopcontrol.js"></script>

<link type="text/css" href="styles/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	// Accordion
	$("#accordion").accordion({ header: "h4" });
	// Tabs
	$('#tabs').tabs();
});
</script>
<?php include_once('includes/contact_form_script.php'); ?> 
</head>
<body>
<?php include_once("includes/index_header.php"); ?>
<?php $link=6; ?>
<?php include_once("includes/top_menu.php"); ?>
<div class="wrapper col2">
<table align="center" cellpadding="0" cellspacing="0" border="0" width="960">
    <tr>
        <td colspan="2"><img src="images/surgery/phaco-operation-comments.jpg" /></td>
    </tr>
    <tr>
        <td align="right" >
        <embed align="middle" src="movie/OperationTheatre/Auto Resize Gallery.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="626" height="300"></embed>
        </td>
	    <td width="334" align="left"><img src="images/surgery/sologun.jpg" /></td>
    </tr>
    <tr>
    <td colspan="2"><?php echo $page_top_desc; ?></td>
    </tr>
</table>
</div>
<div class="wrapper col3">
  <div id="container">
    <div id="content" align="justify">
      <?php echo $page_left_desc; ?>
      <h2>write for an enquiry</h2>
      <div id="respond">
         <?php include_once("includes/contact_form.php");?>
      </div>
    </div>
    <div id="column" align="justify">
      <?php echo $page_right_desc; ?>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php include_once("includes/bottom_menu.php"); ?>
<?php include_once("includes/footer.php"); ?>
</body>
</html>