<?php
	function validateUser(&$errors, $field_list, &$volunteer, &$firstname) {
		include_once('class/DB.class.php');
		$db = new DB();
		$db->connect();
		$result = $db->select('login', 'username = "'.$field_list['username'].'"');
        
        if (!isset($result[0])) {
                $errors['username'] = 'Invalid Username or Password!';
        }

		foreach ($result as $user) {
            if ($field_list['password'] != $user['password']) {
            	// show the error if the email has been occupied
                $errors['username'] = 'Invalid Username or Password!';
            } else {
            	if ($user['volunteer'] == 1) {
            		$volunteer = 1;
                    $result_2 = $db->select('volunteer', 'username_vol ="'.$field_list['username'].'"');
                    foreach ($result_2 as $row) {
                        $firstname = $row['firstname'];
                    }
            	} else {
                    $volunteer = 0;
                    $result_2 = $db->select('client', 'username ="'.$field_list['username'].'"');
                    foreach ($result_2 as $row) {
                        $firstname = $row['firstname'];
                    }
                }

            }
        }
	}
?>
