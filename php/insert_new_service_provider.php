<?php
	include_once('../class/DB.class.php');
	$db = new DB();
	$db->connect();

	$data = array(
		    "name" => json_encode($_POST['provider_name']),
		    "service_id" => json_encode($_POST['service']),
		    "number" => json_encode($_POST['number']),
		    "email" => json_encode($_POST['email']),
		    "link" => json_encode($_POST['link'])
	);

	$db->insert($data, 'service_provider');
	header("location: ../vol_request.php")
?>