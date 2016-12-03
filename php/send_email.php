<?php
	
	$to = $_GET['q'];
	$subject = "Message from helpdesk";
	$txt = $_GET['p'];
	$headers = "From: www.helpdesk.lennonzf.com";

	mail($to,$subject,$txt,$headers);

	echo "<h2>Email has been sent</h2>";
	echo "<a  id='add_service_ok_a' href='#' onClick='location.reload();'><div id='ok_service'>OK</div></a>";

?>