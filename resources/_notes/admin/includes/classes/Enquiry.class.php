<?php
class Enquiry{

	var $enq_id;
	var $name;
	var $address;
	var $phone;
	var $country;
	var $email;
	var $comment;
	var $create_date;
	var $ip;
	var $note;
	
	function Enquiry(){
		
	}
	
	public function editEnquiry(){
		$sql = "UPDATE tbl_enq SET note = '".$this->note."' WHERE enq_id = '".$this->enq_id."'"; 
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function deleteEnquiry(){
		$sql = "DELETE FROM tbl_enq WHERE WHERE enq_id = '".$this->enq_id."'";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function EnquiryArray($cond = 1){
		$sql = "SELECT enq_id, name, address, phone, country, email, comment, create_date, ip, note FROM tbl_enq WHERE ".$cond." ORDER BY create_date DESC";
		$resultSet  = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$enquiryArray = array();
			while($result = mysql_fetch_array($resultSet)){
				extract($result);
				$enquiryArray[$enq_id]['enq_id'] = $enq_id;
				$enquiryArray[$enq_id]['name'] = $name;
				$enquiryArray[$enq_id]['address'] = $address;
				$enquiryArray[$enq_id]['phone'] = $phone;
				$enquiryArray[$enq_id]['country'] = $country;
				$enquiryArray[$enq_id]['extra_styles'] = $extra_styles;
				$enquiryArray[$enq_id]['email'] = $email;
				$enquiryArray[$enq_id]['comment'] = $comment;
				$enquiryArray[$enq_id]['create_date'] = $create_date;
				$enquiryArray[$enq_id]['ip'] = $ip;
				$enquiryArray[$enq_id]['note'] = $note;
			}
			return $enquiryArray;
		}else{
			return false;
		}
	}
	public function EnquiryRecord($enq_id){
		$sql = "SELECT enq_id, name, address, phone, country, email, comment, create_date, ip, note FROM tbl_enq WHERE enq_id = '".$enq_id."' ORDER BY create_date DESC Limit 0,1";
		$resultSet  = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$result = mysql_fetch_array($resultSet);
			$this->enq_id = $result['enq_id'];
			$this->name = $result['name'];
			$this->address = $result['address'];
			$this->phone = $result['phone'];
			$this->country = $result['country'];
			$this->email = $result['email'];
			$this->comment = $result['comment'];
			$this->create_date = $result['create_date'];
			$this->ip = $result['ip'];
			$this->note = $result['note'];
			return;
		}else{
			return false;
		}
	}
	
}
?>