<?php
function redirect($path = '',$querystring_array = ''){
	$query_string = '';
	if($path == ''){
		$path = 'index.php';
	}
	if(is_array($querystring_array)){
		foreach($querystring_array as $key => $value){
			$query_string.= ($query_string != '') ? '&'.$key.'='.$value : $key.'='.$value;
		}
	}
	$query_string = ($query_string != '') ? '?'.$query_string : '';
	echo '<script language="javascript" type="text/javascript">window.location="'.$path.$query_string.'";</script>';
	exit();
}
?>