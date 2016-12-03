<?php
	include_once('../class/DB.class.php');
    include_once('global.inc');
	$db = new DB();
	$db->connect();

	$result = $db->select('job_pool', 'job_id = "'.$_GET['keyword'].'"');
	$username_vol = "no";
	foreach ($result as $key) {
		if ($key['username_vol'] != 'waiting') {
			$username_vol = $key['username_vol'];
		}
	}

	if ($username_vol == "no") {
		$db->delete('job_pool', 'job_id = "'.$_GET['keyword'].'"');
	} else {

		$result_request_1 = $db->select('volunteer', 'username_vol = "'.$username_vol.'"');
		$number = 0;
		foreach ($result_request_1 as $key) {
			$number = $key['request'] - 1;
		}

		$db->update_column('request', $number, 'volunteer', 'username_vol = "'.$username_vol.'"');
		$db->delete('job_pool', 'job_id = "'.$_GET['keyword'].'"');
	}
	    echo"<script> 
		location.href= '../status_user.php';
		alert('You have deleted your request');
		</script>";
?>