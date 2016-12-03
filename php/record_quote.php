<?php
	include_once('../class/DB.class.php');
	$db = new DB();
	$db->connect();

	$preference_result = $db->select('quotes', 'job_id = "'.$_POST['job_id'].'"');
	$number_quote = 1;
	foreach ($preference_result as $key) {
		$number_quote++;
	}

	$today_date = date("Y-m-d");
	
	$data = array(
		    "job_id" => json_encode($_POST['job_id']),
		    "provider_id" => json_encode($_POST['provider_id']),
		    "install_cost" => json_encode($_POST['install']),
		    "running_cost" => json_encode($_POST['running']),
		    "running_cost_per_id" => json_encode($_POST['period']),
		    "billed_id" => json_encode($_POST['billed']),
		    "status" => 1,
		    "preference" => $number_quote,
		    "info" => json_encode($_POST['info']),
		    "date" => json_encode($today_date),
		    "accept" => 0
	);

	$db->insert($data, 'quotes');
	
	header("location: ../quotes.php?keyword=".$_POST['job_id']."");
?>