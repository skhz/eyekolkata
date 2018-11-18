<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo $page_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="Page-Enter" content="blendTrans(Duration=4.0)" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery.slidepanel.setup.js"></script>
<script type="text/javascript" src="scripts/jquery.cycle.min.js"></script>

<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/scrolltopcontrol.js"></script>


<script type="text/javascript" src="scripts/ddpowerzoomer.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($){ //fire on DOM ready
     $('img.showcase').addpowerzoom() //add zoom effect to images with CSS class "showcase"
     $('#gallerydiv img').addpowerzoom() //add zoom effect to all images inside DIV with ID "gallerydiv"
})
</script>
    
    
<script type="text/javascript" src="scripts/crawler.js"></script>
<script type="text/javascript">
	marqueeInit({
		uniqueid: 'mycrawler',
		style: {
			'padding': '0',
			'width': '530px',
			'background': 'lightyellow',
			'border': '0px groove #F3F3F3'
		},
		inc: 3, //speed - pixel increment for each iteration of this marquee's movement
		mouse: 'cursor driven', //mouseover behavior ('pause' 'cursor driven' or false)
		moveatleast: 1,
		neutral: 150,
		savedirection: true
	});
</script>
    
    
    
    
    
    
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
   
    
</head>
<body>

<?php include_once("includes/index_header.php"); ?>

<?php $link=1; ?>
<?php include_once("includes/top_menu.php"); ?>
<br /><br />
<?php include_once("includes/home/intro.php"); ?>
<?php //include_once("includes/home/phaco.php"); ?>
<div class="wrapper col3" >
  <div id="homecontent">
    <div class="fl_left">
    	<?php echo $page_left_desc; ?>
    </div>
    <div class="fl_right" align="justify">
        <?php echo $page_right_desc; ?>
    </div>
  </div>
</div>
<?php include_once("includes/bottom_menu.php"); ?>
<?php include_once("includes/footer.php"); ?>
</body>
</html>