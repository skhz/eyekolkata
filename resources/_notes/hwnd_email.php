<?php
include_once("includes/config.php");
$pageName=$_POST['txtPageName'];
$name=$_POST['txtName'];
$address=$_POST['txtAddress'];
$phone=$_POST['txtPhone'];
$country=$_POST['txtCountry'];
$email=$_POST['txtEmail'];
$comments=$_POST['txtComment'];
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){   //check ip from share internet
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //to check ip is pass from proxy
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip=getRealIpAddr();
	$sql = "INSERT INTO tbl_enq (name, address, phone, country, email, comment, ip) 
			VALUES('".$name."', '".$address."', '".$phone."', '".$country."', '".$email."', '".$comments."', '".$ip."')";
	if(mysql_query($sql)){
		$_SESSION['msg'] = '<div>Thank you. Your Comment is important to us.</div>';
	}else{
		$_SESSION['msg'] = '<div>Error! Please try again..</div>';
	}
	header("location:".$pageName."#thankyou");
?>