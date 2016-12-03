<?php
	include_once('../class/DB.class.php');
    include_once('global.inc');
	$db = new DB();
	$db->connect();
	$data = $_SESSION['username'];
	
	$result_request_1 = $db->select('volunteer', 'username_vol = "'.$data.'"');
	$number = 0;
	foreach ($result_request_1 as $key) {
		$number = $key['request'] - 1;
	}

	$db->update_column('username_vol', '"waiting"', 'job_pool', 'job_id = '.$_GET['keyword'].'');
	$db->update_column('status', '1', 'job_pool', 'job_id = '.$_GET['keyword'].'');
	$db->update_column('request', $number, 'volunteer', 'username_vol = "'.$data.'"');
	    echo"<script> 
		location.href= '../status_vol.php';
		alert('You have successfully canceled you job');
		</script>";
	
?>