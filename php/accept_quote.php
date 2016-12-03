<?php
	include_once('../class/DB.class.php');
    $db = new DB();
    $db->connect();

	$to = $_GET['q'];
	$subject = "Job notification";
	$txt = "The client has accepted the quote, your job finished";
	$headers = "From: www.helpdesk.lennonzf.com";

	mail($to,$subject,$txt,$headers);

	echo "<h2>Service confirmed, Thank you</h2>";
	echo "<a  id='add_service_ok_a' href='#' onClick='location.reload();'><div id='ok_service'>OK</div></a>";

	$db->update_column('status', 4, 'job_pool', 'job_id = "'.$_GET['id'].'"');
	$db->update_column('accept', 2, 'quotes', 'id = "'.$_GET['quote'].'"');

	$result_request_1 = $db->select('volunteer', 'username_vol = "'.$to.'"');
	$number = 0;
	foreach ($result_request_1 as $key) {
		$number = $key['request'] - 1;
	}
	
	$db->update_column('request', $number, 'volunteer', 'username_vol = "'.$to.'"');

?>