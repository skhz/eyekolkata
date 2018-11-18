<?php include_once('includes/config.php'); 
$faqArray = array();
$FAQ = new FAQ();
$faqArray = $FAQ->FAQArray();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo $page_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery.slidepanel.setup.js"></script>
<script type="text/javascript" src="scripts/jquery.cycle.min.js"></script>
<script type="text/javascript" src="scripts/jquery.cycle.setup.js"></script>
<?php include_once('includes/contact_form_script.php'); ?> 
</head>
<body>
<?php include_once("includes/index_header.php"); ?>
	<?php $link=8; ?>
    <?php include_once("includes/top_menu.php"); ?>
<div class="wrapper col3">
  <div id="container">
     <table class="faq-table">
   	<?php if(!empty($faqArray)){?>
   
		<?php foreach($faqArray as $key => $val){?> 
        <tr>
        	<th width="44"><img src="images/faq/question-icon.jpg" alt="" /></th>
        	<th width="904"><?php echo $faqArray[$key]['ques']; ?></th>
   	  	</tr>
        <tr>
        	<td colspan="2"><?php echo $faqArray[$key]['ans']; ?></td>
		</tr>
    <?php }
	}else{?>
    	<tr>
        	<th width="44"><img src="images/faq/question-icon.jpg" alt="" /></th>
        	<th width="904">Content comming soon..</th>
            <tr>
        	<td colspan="2"><?php echo $faqArray[$key]['ans']; ?></td>
		</tr>
   	  	</tr>
    <?php }?>
    </table>
   <h2>write for an enquiry</h2>
      <div id="respond">
          <?php include_once("includes/contact_form.php");?>
      </div>
  </div>
</div>
<?php include_once("includes/bottom_menu.php"); ?>
<?php include_once("includes/footer.php"); ?>
</body>
</html>