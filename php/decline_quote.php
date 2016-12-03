<?php
	include_once('../class/DB.class.php');
    $db = new DB();
    $db->connect();

	$to = $_GET['q'];
	$subject = "Job notification";
	$txt = "The client has declined the quote, Please check another quote for the client";
	$headers = "From: www.helpdesk.lennonzf.com";

	mail($to,$subject,$txt,$headers);

	echo "<h2>You declined a quote, please wait for a new quote.</h2>";
	echo "<a  id='add_service_ok_a' href='#' onClick='location.reload();'><div id='ok_service'>OK</div></a>";

	$db->update_column('status', 2, 'job_pool', 'job_id = "'.$_GET['id'].'"');
	$db->update_column('accept', 3, 'quotes', 'id = "'.$_GET['quote'].'"');
	    echo"<script> 
		alert('You have declined the quote');
		</script>";

?>