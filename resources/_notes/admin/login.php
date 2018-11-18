<?php include_once('config.php');?>
<?php
if($_POST && $login->loginCheck($_POST['txtUserName'],$_POST['txtPassword'])){
	redirect('index.php');
}else{
	$msg = '<div class="pad20">
				<div class="message error close">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vulputate ligula est, ut facilisis magna. Quisque vitae est sapien. Etiam in diam ipsum. Etiam condimentum euismod eleifend. Vivamus gravida nunc in augue accumsan vitae pharetra tellus pretium. Vestibulum non mauris in nunc dictum faucibus.</p>
				</div>
			</div>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Winfred Admin - Login</title>
<link type="text/css" href="styles/login.css" rel="stylesheet" />	
<link type="text/css" href="styles/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
<link type="text/css" href="styles/core.css" rel="stylesheet" />
	
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#submit').click(function(){
		if($('#txtUserName').val() == ''){
			alert('Enter User Name');
			return false;
		}
		if($('#txtPassword').val() == ''){
			alert('Enter password');
			return false;
		}
	});
});
</script>
</head>
<body>
<div id="container">
	<div class="logo">
		<a href=""><img src="images/logo.png" alt="" /></a>
	</div>
	<div id="box" >
		<form name="frmLogin" id="frmLogin" action="<?php echo PAGE_NAME; ?>" method="POST">
		<p class="main">
			<label>Username: </label>
			<input type="text" id="txtUserName" name="txtUserName" value="" /> 
			<label>Password: </label>
			<input type="password" id="txtPassword" name="txtPassword" value="">
		</p>
		<p class="space">
			<span><input type="checkbox" />Remember me</span>
			<input type="submit" id="submit" title="Click" value="Login" class="login" />
		</p>
		</form>
	</div>
	<?php echo $msg; ?>
</div>
</body>
</html>