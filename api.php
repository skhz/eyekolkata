<?php
if(isset($_POST)){
	//echo json_encode($_POST);
	$message = join(' <br> ',$_POST);
	$to = "ddecbb@gmail.com";
	$subject = "Message from eyekolkata.com";
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: noreply-eyekolkata@eyekolkata.com' . "\r\n";
	$headers .= 'Bcc: sourav.kr.hazra@gmail.com' . "\r\n";
	mail($to,$subject,$message,$headers);
	die();
}
?>
