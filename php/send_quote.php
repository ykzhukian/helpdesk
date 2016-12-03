<?php
	include_once('../class/DB.class.php');
    $db = new DB();
    $db->connect();

	$to = $_GET['q'];
	$subject = $_GET['title'];
	$txt = $_GET['p'];
	$headers = "From: www.helpdesk.lennonzf.com";

	mail($to,$subject,$txt,$headers);

	echo "<h2>Notification has been sent</h2>";
	echo "<a  id='add_service_ok_a' href='#' onClick='location.reload();'><div id='ok_service'>OK</div></a>";

	$db->update_column('status', 3, 'job_pool', 'job_id = "'.$_GET['id'].'"');
	$db->update_column('accept', 1, 'quotes', 'id = "'.$_GET['quote'].'"');

?>