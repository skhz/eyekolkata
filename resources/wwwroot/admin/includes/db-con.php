<?php
//Defination for DATABASE
define(DB_HOST,'localhost',true);
define(DB_USER,'root',true);
define(DB_PASSWORD,'',true);
define(DB_NAME,'eyekolkata',true);
define(DB_PREFIX,'',true);
//Darabase Connection
$db_conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
$db_select = mysql_select_db(DB_PREFIX.DB_NAME,$db_conn);
?>