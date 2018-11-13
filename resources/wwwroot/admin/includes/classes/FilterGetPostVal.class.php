<?php
class FilterGetPostVal{

	var $arrGetPost;
	var $valGetPost;
	
	function FilterGetPostVal(){
		$arrGetPost = array();
		$valGetPost = '';
	}
		
	public function filter($arrGetPost){
		if(is_array($arrGetPost)){
			foreach($arrGetPost as $key => $val){
				if(is_array($val)){
					$arrGetPost[$key] = $this->filter($val);
				}else{
					$arrGetPost[$key] = $this->valuefilter($val);
				}
			}
		}
		return $arrGetPost;
	}
	
	private function valuefilter($val){
		return trim($val);
	}

}
?>