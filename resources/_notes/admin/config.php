<?php
//error_reporting(E_ERROE);
ob_start();
ob_clean();
session_start();

//Defination for INCLUDE DIR
define(INCLUDES,'includes/',true);
define(CONTENTS,INCLUDES.'contents/',true);
define(LEFT_BAR,CONTENTS.'left-bar/',true);
define(CLASSES,INCLUDES.'classes/',true);
define(CUSTOM_FUNCTIONS,INCLUDES.'custom-functions/',true);

include_once(INCLUDES.'db-con.php');
//Defination for IMAGE DIE
define(IMAGES,'images/',true);
define(ICON_IMAGES,IMAGES.'icons/',true);

//Current Page Name
define('PAGE_NAME',strtolower(basename($_SERVER['SCRIPT_FILENAME'])));

include_once(CLASSES.'Message.class.php');
include_once(CLASSES.'Login.class.php');
include_once(CUSTOM_FUNCTIONS.'functions.php');

$login = new Login();
if( PAGE_NAME != 'login.php' && !$login->checkLogin() ){
	redirect('login.php');
}

include_once(CLASSES.'FilterGetPostVal.class.php');
$filterGetPostVal = new FilterGetPostVal();
$_GET = $filterGetPostVal->filter($_GET);
$_POST = $filterGetPostVal->filter($_POST);

include_once(CLASSES.'CMSHwnd.class.php');
include_once(CLASSES.'Enquiry.class.php');
include_once(CLASSES.'FAQ.class.php');
?>