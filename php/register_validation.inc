<?php
	function validateEmail(&$errors, $field_list, $field_name) {
		include_once('class/DB.class.php');
		$db = new DB();
		$db->connect();
		$result = $db->select_all('login');
		foreach ($result as $user) {
            if ($field_list[$field_name] == $user['username']) {
            	// show the error if the email has been occupied
                $errors[$field_name] = 'This Email has been signed up';
            }
        }
	}
?>
