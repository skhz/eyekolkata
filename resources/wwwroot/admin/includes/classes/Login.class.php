<?php
class Login{
	
	function Login(){
		//Constructor	
	}
	
	public function loginCheck($userLoginID, $loginPassword ){
		$sql="Select user_id, user_name, password from tbl_user WHERE user_name='".$userLoginID."' AND password='".$loginPassword."' AND is_active = 'Y' Limit 0,1";
		$resultSet=mysql_query($sql);
		if(mysql_num_rows($resultSet)>0){
			$result=mysql_fetch_array($resultSet);
			$_SESSION['admin']=array();
			$_SESSION['admin']['loginID'] = $result['user_id'];
			$_SESSION['admin']['userName'] = $result['user_name'];
			return true;
		}
		return false;
	}
	
	public function checkLogin(){
		if((int)$_SESSION['admin']['loginID'] > 0){
			if(PAGE_NAME == 'login.php'){
				redirect('index.php');
			}
			return true;
		}else{
			return false;
		}
	}
	
}
?>