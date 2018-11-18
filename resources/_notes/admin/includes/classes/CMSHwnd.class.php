<?php
class CMSHwnd{

	var $cms_id;
	var $cms_type;
	var $page_name;
	var $page_title;
	var $meta_keyword;
	var $meta_description;
	var $extra_styles;
	var $page_heading;
	var $page_top_desc;
	var $page_left_desc;
	var $page_right_desc;
	var $page_info;
	var $create_date;
	var $last_update;
	
	function CMSHwnd($cms_id='', $page_name = '', $page_title = '', $meta_keyword = '', $meta_description = '', $extra_styles = '', $page_heading = '', $page_top_desc = '', $page_left_desc = '', $page_right_desc = '', $page_info = ''){
		$this->cms_id = $cms_id;
		$this->page_name = $page_name;
		$this->page_title = $page_title;
		$this->meta_keyword = $meta_keyword;
		$this->meta_description = $meta_description;
		$this->extra_styles = $extra_styles;
		$this->page_heading = $page_heading;
		$this->page_top_desc = $page_top_desc;
		$this->page_left_desc = $page_left_desc;
		$this->page_right_desc = $page_right_desc;
		$this->page_info = $page_info;
	}
	
	public function addCMS(){
		echo $sql = "INSERT INTO tbl_cms (page_name, page_title, meta_keyword, meta_description, extra_styles, 
											page_heading, page_top_desc, page_left_desc, page_right_desc, page_info, create_date) 
					VALUES ('".$this->page_name."', '".$this->page_title."', '".$this->meta_keyword."', 
							'".$this->meta_description."', '".$this->extra_styles."', '".$this->page_heading."',
							'".$this->page_top_desc."', '".$this->page_left_desc."', '".$this->page_right_desc."', '".$this->page_info."', NOW())";
		mysql_query($sql);
		return mysql_insert_id();
	}
	
	public function editCMS(){
		$sql = "UPDATE tbl_cms SET page_name = '".$this->page_name."',
							page_title = '".$this->page_title."', meta_keyword = '".$this->meta_keyword."', 
							meta_description = '".$this->meta_description."', extra_styles = '".$this->extra_styles."',
							page_heading = '".$this->page_heading."', page_top_desc = '".$this->page_top_desc."',
							page_left_desc = '".$this->page_left_desc."', page_right_desc = '".$this->page_right_desc."',
							page_info = '".$this->page_info."', last_update = NOW() WHERE cms_id = '".$this->cms_id."'"; 
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function deleteCMS(){
		$sql = "DELETE FROM tbl_cms WHERE WHERE cms_id = '".$this->cms_id."')";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function CMSArray($cond = 1){
		$sql = "SELECT cms_id, page_name, page_title, meta_keyword, meta_description, extra_styles, page_heading, page_top_desc, page_left_desc, page_right_desc, page_info, create_date, last_update FROM tbl_cms WHERE ".$cond." ORDER BY page_name";
		$resultSet  = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$cmsArray = array();
			while($result = mysql_fetch_array($resultSet)){
				extract($result);
				$cmsArray[$cms_id]['cms_id'] = $cms_id;
				$cmsArray[$cms_id]['page_name'] = $page_name;
				$cmsArray[$cms_id]['page_title'] = $page_title;
				$cmsArray[$cms_id]['meta_keyword'] = $meta_keyword;
				$cmsArray[$cms_id]['meta_description'] = $meta_description;
				$cmsArray[$cms_id]['extra_styles'] = $extra_styles;
				$cmsArray[$cms_id]['page_heading'] = $page_heading;
				$cmsArray[$cms_id]['page_top_desc'] = $page_top_desc;
				$cmsArray[$cms_id]['page_left_desc'] = $page_left_desc;
				$cmsArray[$cms_id]['page_right_desc'] = $page_right_desc;
				$cmsArray[$cms_id]['page_info'] = $page_info;
				$cmsArray[$cms_id]['create_date'] = $create_date;
				$cmsArray[$cms_id]['last_update'] = $last_update;
			}
			return $cmsArray;
		}else{
			return false;
		}
	}
	public function CMSRecord($cms_id){
		$sql = "SELECT cms_id, page_name, page_title, meta_keyword, meta_description, extra_styles, page_heading, page_top_desc, page_left_desc, page_right_desc, page_info, create_date, last_update FROM tbl_cms WHERE cms_id = '".$cms_id."' Limit 0,1";
		$resultSet  = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$result = mysql_fetch_array($resultSet);
			$this->cms_id = $result['cms_id'];
			$this->page_name = $result['page_name'];
			$this->page_title = $result['page_title'];
			$this->meta_keyword = $result['meta_keyword'];
			$this->meta_description = $result['meta_description'];
			$this->extra_styles = $result['extra_styles'];
			$this->page_heading = $result['page_heading'];
			$this->page_top_desc = $result['page_top_desc'];
			$this->page_left_desc = $result['page_left_desc'];
			$this->page_right_desc = $result['page_right_desc'];
			$this->page_info = $result['page_info'];
			return;
		}else{
			return false;
		}
	}
}
?>