<?php
	include_once('../class/DB.class.php');
    include_once('global.inc');
	$db = new DB();
	$db->connect();
	$data = $_SESSION['username'];
	
	$result_request_1 = $db->select('volunteer', 'username_vol = "'.$data.'"');
	$number = 0;
	foreach ($result_request_1 as $key) {
		$number = $key['request'] + 1;
	}
	if ($number < 3) {
		$db->update_column('username_vol', '"'.$data.'"', 'job_pool', 'job_id = '.$_GET['keyword'].'');
		$db->update_column('status', 2, 'job_pool', 'job_id = '.$_GET['keyword'].'');
		$db->update_column('request', $number, 'volunteer', 'username_vol = "'.$data.'"');
		echo"<script> 
		location.href= '../jobpool.php';
		alert('You have successfully taken a job');
		</script>";
	} else {
		echo"<script>location.href= '../jobpool.php?sorry=failed';alert('You have failed to take a job');
		</script>";
	}
	
?>