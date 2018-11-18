<?php
class FAQ{

	var $faq_id;
	var $ques;
	var $ans;
	var $create_date;
	var $last_update;
	var $is_active;
	
	function FAQ( $ques = '', $ans = '', $is_active = '', $faq_id = ''){
		$this->faq_id = $faq_id;
		$this->ques = $ques;
		$this->ans = $ans;
		$this->is_active = $is_active;
	}
	
	public function addFAQ(){
		echo $sql = "INSERT INTO tbl_faq (ques, ans, create_date, is_active) 
					VALUES ('".$this->ques."', '".$this->ans."', NOW(), '".$this->is_active."')";
		mysql_query($sql);
		return mysql_insert_id();
	}
	
	public function editFAQ(){
		$sql = "UPDATE tbl_faq SET ques = '".$this->ques."', ans = '".$this->ans."', last_update = NOW(), is_active = '".$this->is_active."' WHERE faq_id = '".$this->faq_id."'"; 
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function deleteFAQ(){
		$sql = "DELETE FROM tbl_faq WHERE WHERE faq_id = '".$this->faq_id."'";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function FAQArray($cond = 1){
		$sql = "SELECT faq_id, ques, ans, create_date, last_update, is_active FROM tbl_faq WHERE ".$cond." ORDER BY create_date";
		$resultSet  = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$FAQArray = array();
			while($result = mysql_fetch_array($resultSet)){
				extract($result);
				$FAQArray[$faq_id]['faq_id'] = $faq_id;
				$FAQArray[$faq_id]['ques'] = $ques;
				$FAQArray[$faq_id]['ans'] = $ans;
				$FAQArray[$faq_id]['is_active'] = $is_active;
				$FAQArray[$faq_id]['create_date'] = $create_date;
				$FAQArray[$faq_id]['last_update'] = $last_update;
			}
			return $FAQArray;
		}else{
			return false;
		}
	}
	public function FAQRecord($faq_id){
		$sql = "SELECT faq_id, ques, ans, create_date, last_update, is_active FROM tbl_faq WHERE faq_id = '".$faq_id."' ORDER BY create_date DESC Limit 0,1";
		$resultSet  = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$result = mysql_fetch_array($resultSet);
			$this->faq_id = $result['faq_id'];
			$this->ques = $result['ques'];
			$this->ans = $result['ans'];
			$this->is_active = $result['is_active'];
			$this->create_date = $result['create_date'];
			$this->country = $last_update['last_update'];
			return;
		}else{
			return false;
		}
	}
	
}
?>