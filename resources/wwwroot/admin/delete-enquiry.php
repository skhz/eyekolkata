<?php
include_once('config.php');
$enq_id = $_POST['enq_id'];
if(!empty($enq_id)){
	if(is_numeric($enq_id)){
		$sql = "DELETE FROM tbl_enq WHERE enq_id = ".$enq_id;
		@mysql_query($sql);
		echo mysql_affected_rows();
	}else{
		echo '';
	}
}else{
	echo '';
}
?>