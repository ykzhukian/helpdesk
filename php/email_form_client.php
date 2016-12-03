<form action="php/send_email_client.php" method="POST" >
	<input name="email_address" type="text" class="invisible" <?php echo 'value="'.$detail['username_vol'].'"'; ?>/>
	<input name="client_name" type="text" class="invisible" <?php echo 'value="'.$row['firstname'].'"'; ?>/>
	<textarea rows="6" cols="51" name="info" id="info" required placeholder="Content.."  ></textarea><br />
    <input type="submit" id="submit_request" value="Send" />
</form>