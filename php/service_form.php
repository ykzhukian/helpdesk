<form id="service_name" action="vol_request.php" method="POST">
<label for="name">Which service do you need: </label>
<select name="name" id="name">';
	<?php
        include_once('class/DB.class.php');
        $db = new DB();
        $db->connect();
        $result = $db->select_all('service');
        foreach($result as $row){
            if ($_POST['name'] == $row['name']){
                echo '<option selected="selected" value="'.$row['name'].'">'.$row['name'].'</option>';
            } else {
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
            }
        }
    ?>
</select>
<input type="submit" name="submit_name" id="submit_name" value="OK" />
<a id="add_pluse" data-reveal-id="myModal" href=""><div id="add_service_plus">+</div></a>
</form>
