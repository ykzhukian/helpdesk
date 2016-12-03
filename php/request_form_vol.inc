<?php
     $language_result = $db->select_all('language');
?>


<form id="request_form_vol" method="POST" action="vol_request.php">
     <label for="username" class="username">Username for Migrant(Email): </label>
     <input type="text" name="username" id="username_re_vol"required /><br />
     <label for="firstname" class="firstname">Firstname: </label>
     <input type="text" name="firstname" id="firstname_re_vol"required />
     <label for="lastname" class="lastname">Lastname: </label>
     <input type="text" name="lastname" id="lastname_re_vol"required/>
     <input type="text" name="service" id="service_re"required <?php echo "value='".$service."'"; ?>/><br/><br />
     <label for="language" class="language">Language: </label>
     <select name="language" id="language" required>
        <?php 
          foreach ($language_result as $key) {
              $date = $key['date'];
              echo "<option value='".$key['id']."'>".$key['name']."</option>";
          }
        ?>
     </select>
     <a id="add_pluse" data-reveal-id="myModal_add_language" href=""><div id="add_language_plus">+</div></a>
     <br />
     <label for="contact_number" class="contact_number">Contact Number: </label>
     <input type="text" name="contact_number" id="contact_number"required /><br />
     <label for="region">Region: </label>
     <input type="text" name="region" id="region"required  /><br />
     <label for="day" class="day">Preferred Day: </label><br />
     <div id="checkbox">
          <input type="checkbox" id="0" name="weekday[]" value="1"><span class="checkbox_span">Mon</span>
          <input type="checkbox" id="1" name="weekday[]" value="2"><span class="checkbox_span">Tue</span>
          <input type="checkbox" id="2" name="weekday[]" value="3"><span class="checkbox_span">Wed</span>
          <input type="checkbox" id="3" name="weekday[]" value="4"><span class="checkbox_span">Thur</span>
          <input type="checkbox" id="4" name="weekday[]" value="5"><span class="checkbox_span">Fri</span>
          <input type="checkbox" id="5" name="weekday[]" value="6"><span class="checkbox_span">Sat</span>
          <input type="checkbox" id="6" name="weekday[]" value="7"><span class="checkbox_span" id="sun">Sun</span>
     </div><br />
     <label for="date" class="date">Convenient Date: </label>
     <input id="datepicker" type="text" name="date" id="date"required /><br />
     <label for="info" class="info">Service Details: </label><br />
     <textarea rows="6" cols="51" name="info" id="info" required placeholder="Please tell us something about what do you need."  ></textarea><br />
     <input type="submit" name="submit_request" id="submit_request" value="Send" />
   <input type="button" onclick="vol_request_cancel_alert()" name="cancel_request" id="cancel_request" value="Cancel" />
 </form>
 <script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: +1});
  });
  </script>