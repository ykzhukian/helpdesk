<?php
	
	$to = $_POST['email_address'];
	$subject = "Message from client";
	$txt = $_POST['info'];
	$headers = "From: ".$_POST['client_name']."";

	mail($to,$subject,$txt,$headers);
	echo 'Email has been sent... Go back in 3 seconds...';

	header( "refresh: 3;url=../status_user.php" );

?>