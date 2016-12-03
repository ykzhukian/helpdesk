<?php
    include_once('../class/DB.class.php');
    include_once('global.inc');
    $db = new DB();
    $db->connect();

    $data = array(
        "service" => json_encode($_POST['service']),
        "username_client" => json_encode($_POST['username_client']),
        "username_vol" => json_encode($_POST['username_vol']),
        "firstname" => json_encode($_POST['firstname']),
        "lastname" => json_encode($_POST['lastname']),
        "language" => json_encode($_POST['language']),
        "region" => json_encode($_POST['region']),
        "number" => json_encode($_POST['contact_number']),
        "detail" => json_encode($_POST['info']),
        "preferred_day" => json_encode(implode(',', $_POST['weekday'])),
        "con_date" => json_encode($_POST['date']),
        "status" => json_encode($_POST['status']),
        "job_id" => json_encode($_POST['job_id'])
    );


    $db->update($data, 'job_pool', 'job_id = '.$_POST['job_id'].'');
    echo"<script> 
		location.href= '../status_user.php';
		alert('You have successfully edited the details');
		</script>";

?>