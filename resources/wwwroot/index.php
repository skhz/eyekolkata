<?php
include_once("includes/config.php");
$page_name = $_GET['page_name'];
$name = explode(".",$page_name);

$page_name = $name[0];
if($page_name == ''){	
	$page_name = 'home'; 
}

$cmsSql = "SELECT cms_id, page_name, page_title, meta_keyword, meta_description, extra_styles, page_heading, page_top_desc, page_left_desc, page_right_desc, page_info, create_date, last_update FROM tbl_cms WHERE page_name = '".$page_name."'";
$cmsResultSet = mysql_query($cmsSql);
if(mysql_num_rows($cmsResultSet) > 0 ){
	if($cmsResult=mysql_fetch_array($cmsResultSet)){
		extract($cmsResult);
	}
}else{
	header('location:nopage.html'); 	
	die();	
}


$file_name=$page_name.'.html';
if(file_exists ($file_name)){
	include_once($page_name.'.html');
}else{
	$file_name=$page_name.'.php';
	if(file_exists ($file_name )){
		include_once($page_name.'.php');
	}else{
		header('location:nopage.html');
	}
}
?>