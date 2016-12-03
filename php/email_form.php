<form>
	<input <?php echo 'id="email_address_'.$index.'"'; ?>  name="email_address" type="text" class="invisible" <?php echo 'value="'.$row['username_client'].'"'; ?>/>
	<textarea rows="6" cols="51" name="info" <?php echo 'id="info_'.$index.'"'; ?> required placeholder="Content.." >Hi, <?php echo $row['firstname']; ?></textarea><br />
    <input type="button" id="submit_request" value="Send" <?php echo 'onClick="sendEmail('.$index.')"'; ?> />
</form>