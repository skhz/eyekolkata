<?php
include_once("includes/config.php");
//echo 'Yahoo'; die();
$page_name = $_GET['page'];
$name = explode(".",$page_name);

$page = $name[0];
if($page == ''){	
	$page = 'home'; 
}//echo $page; die();

$cmsSql = "SELECT cms_id, page_name, page_title, meta_keyword, meta_description, extra_styles, page_heading, page_top_desc, page_left_desc, page_right_desc, page_info, create_date, last_update FROM tbl_cms WHERE page_name = '".$page."'";
$cmsResultSet = mysqli_query($db_conn,$cmsSql);
//print_r($cmsResultSet); die();

if(mysqli_num_rows($cmsResultSet) > 0 ){ //echo 'DDEC'; die();
	if($cmsResult=mysqli_fetch_array($cmsResultSet)){
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