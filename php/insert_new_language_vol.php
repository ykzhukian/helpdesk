<?php
	include_once('../class/DB.class.php');
    include_once('global.inc');
	$db = new DB();
	$db->connect();

	$input = $_GET["q"];

	$language_now = $db->select_all('language');
	$break_1 = 0;
	foreach ($language_now as $k) {
		if ($k['name'] == $input) {
			echo "<h2 id='error_message_language' class='error_red'>Language Exists</h2>";
			echo '<form id="new_language">
                    <label for="service_name" id="add_service_label">Add a new language to the list:</label>
                    <input type="text" name="new_language_name" id="new_language_name" required />
                    <input type="button" name="new_language_submit" id="new_language_submit" value="Add" onClick="add_language();"/>       
                </form> ';
			$break_1 = 1;
		}
	}

	if ($break_1 == 0) {
		$data = array(
		    "name" => json_encode($input)
		);

		$db->insert($data, 'language');
		echo "<h2>You have successfully added a new language</h2>";
		echo "<a  id='add_service_ok_a' href='#' onClick='location.reload();'><div id='ok_service'>OK</div></a>";
	}
?>