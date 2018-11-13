<?php
	class DBConn{
		
		var $conn;
		var $db_select;
		var $result;
		
		function DBConn($host,$user,$password,$database){
			global $Message;
			if(!$this->conn = @mysql_connect($host,$user,$password)){
				$Message->prepearMessageGroup("Database connection fail. Please try again.<br /><b>MySql Error : </b><br />&nbsp;&nbsp;&nbsp;".mysql_error($this->conn));
				return false;
			}
			if(!$this->db_select = @mysql_select_db($database,$this->conn)){
				$Message->prepearMessageGroup("Database selection fail. Please try again.<br /><b>MySql Error : </b><br />&nbsp;&nbsp;&nbsp;".mysql_error($this->conn));
				return false;
			}else{
				return true;
			}
		}
		
		function dBQueryExecute($sql){
			global $Message;
			if($this->result = @mysql_query($sql,$this->conn)){
				return $this->result;
			}else{
				$Message->prepearMessageGroup("This query is not execute for the following reason.<br /><b>MySql Error : </b><br />&nbsp;&nbsp;&nbsp;".mysql_error($this->conn)."<br /><br />SQL : ".$sql);
				return false;
			}
		}
		
		function mysqlInsertId(){
			return mysql_insert_id($this->conn);
		}
		
		function mysqlAffectedRows(){
			return mysql_affected_rows($this->conn);
		}
		
		function prepDBInsert($value){
			return str_replace(array('\'','"'),array('&sbquo;','"'),trim($value));
		}
	}
	
	/*Try to connect with database*/
	$DB = new DBConn($db_host,$db_usr,$db_pwd,$db_name);
?>