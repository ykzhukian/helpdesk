<?php
    include_once('../class/DB.class.php');
    include_once('global.inc');
    $db = new DB();
    $db->connect();

    $index = $_POST['preference'];
    if ($_POST['preferred'] == "10" && $index != "1") {
        $index = 1;
        $db->update_column( 'preference', 3, 'quotes', 'job_id = '.$_POST['job_id'].' AND preference = "2"');
        $db->update_column( 'preference', 2, 'quotes', 'job_id = '.$_POST['job_id'].' AND preference = "1"');
    }

    $today_date = date("Y-m-d");
    $data = array(
        "job_id" => json_encode($_POST['job_id']),
            "provider_id" => json_encode($_POST['provider_id']),
            "install_cost" => json_encode($_POST['install']),
            "running_cost" => json_encode($_POST['running']),
            "running_cost_per_id" => json_encode($_POST['period']),
            "billed_id" => json_encode($_POST['billed']),
            "status" => json_encode($_POST['status']),
            "preference" => $index,
            "info" => json_encode($_POST['info']),
            "date" => json_encode($today_date)
    );


    $db->update($data, 'quotes', 'id = '.$_POST['id'].'');
    header("location: ../quotes.php?keyword=".$_POST['job_id']."");

?>