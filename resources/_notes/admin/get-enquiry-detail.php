<?php
include_once('config.php');

$enq_id = $_POST['enq_id'];
if(!empty($enq_id)){
	if(is_numeric($enq_id)){
		$sql = "SELECT name, address, phone, country, email, comment, create_date, ip, note FROM tbl_enq WHERE enq_id = ".$enq_id;
		$resultSet = mysql_query($sql);
		if(mysql_num_rows($resultSet) > 0){
			$html = '';
			$result = mysql_fetch_array($resultSet);
			extract($result);
			   $html = '<p>Name : <strong>'.$name.'</strong></p>
						<p>Address : '.$address.'</p>
						<p>Email : <strong>'.$email.'</strong></p>
						<p>Phone : <strong>'.$phone.'</strong></p>
						<p>Country : <strong>'.$country.'</strong></p>
						<p><strong>Comment </strong>: '.$comment.'</p>';
				echo $html;
		}else{
			echo '';
		}
	}else{
		echo '';
	}
}else{
	echo '';
}
?>