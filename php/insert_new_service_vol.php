<?php
	include_once('../class/DB.class.php');
    include_once('global.inc');
	$db = new DB();
	$db->connect();

	$input = $_GET["q"];

	$service_now = $db->select_all('service');
	$break = 0;
	foreach ($service_now as $key) {
		if ($key['name'] == $input) {
			echo "<h2 id='error_message' class='error_red'>Service Exists</h2>";
			echo '<form id="new_service">
                    <label for="service_name" id="add_service_label">Add a new service to the list:</label>
                    <input type="text" name="new_service_name" id="new_service_name" required />
                    <input type="button" name="new_service_submit" id="new_service_submit" value="Add" onClick="add_service();"/>       
                </form>';
			$break = 1;
		}
	}

	if ($break == 0) {
		$data = array(
		    "name" => json_encode($input)
		);

		$db->insert($data, 'service');
		echo "<h2>You have successfully added a new service</h2>";
		echo "<a  id='add_service_ok_a' href='#' onClick='location.reload();'><div id='ok_service'>OK</div></a>";
	}
?>