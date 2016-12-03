<?php
	include_once('../class/DB.class.php');
	$db = new DB();
	$db->connect();
	$job_id = $_GET['job_id'];
	$data = $_POST['assign_result_email'];
	
	$result_request_1 = $db->select('volunteer', 'username_vol = "'.$data.'"');
	$number = 0;
	foreach ($result_request_1 as $key) {
		$number = $key['request'] + 1;
	}
	if ($number < 3) {
		$db->update_column('username_vol', '"'.$data.'"', 'job_pool', 'job_id = '.$job_id.'');
		$db->update_column('status', 2, 'job_pool', 'job_id = '.$job_id.'');
		$db->update_column('request', $number, 'volunteer', 'username_vol = "'.$data.'"');
		echo"<script> 
		location.href= '../jobpool.php';
		alert('You have successfully assigned a job');
		</script>";
	} else {
		echo"<script>location.href= '../jobpool.php?sorry=failed';alert('You have failed to assign a job');
		</script>";
	}
	
?>