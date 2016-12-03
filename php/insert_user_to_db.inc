<?php
	include_once('class/DB.class.php');
	$db = new DB();
	$db->connect();

	$data = array(
		    "username" => json_encode($_POST['username']),
		    "firstname" => json_encode($_POST['firstname']),
		    "lastname" => json_encode($_POST['lastname']),
		    "language" => json_encode($_POST['language']),
		    "region" => json_encode($_POST['region']),
		    "number" => json_encode($_POST['contact_number'])
	);

	$login_data = array(
			"username" => json_encode($_POST['username']),
			"password" => json_encode($_POST['password']),
			"volunteer" => 0
		);
	
	$db->insert($data, 'client');
	$db->insert($login_data, 'login');
?>