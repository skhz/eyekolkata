<?php
//Defination for DATABASE
define(DB_HOST,'localhost',true);
define(DB_USER,'eyekolkatauser',true);
define(DB_PASSWORD,'amKGALs5i@Ow',true);
define(DB_NAME,'dbddec',true);
define(DB_PREFIX,'',true);
//Darabase Connection
$db_conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db_select = mysqli_select_db(DB_PREFIX.DB_NAME,$db_conn); 


if($db_conn){
//echo 'Connection  Success!!';
}else{
echo 'connection Fail';
}
//die();
?>