<?php
     $new_result = $db->select('job_pool', 'job_id = "'.$row['job_id'].'"');
     foreach ($new_result as $key) {
          $username_vol = $key['username_vol'];
          $username_client = $key['username_client'];
          $new_firstname = $key['firstname'];
          $new_lastname = $key['lastname'];
          $new_language = $key['language'];
          $new_service = $key['service'];
          $new_contact_number = $key['number'];
          $new_preferred_day = $key['preferred_day'];
          $new_con_date = $key['con_date'];
          $new_status = $key['status'];
          $new_detail = $key['detail'];
          $new_region = $key['region'];
          $job_id = $key['job_id'];
     }

?>
<form id="edit_form" method="POST" action="php/edit_detail.php">
     <input type="text" class="invisible" name="status" <?php echo "value='".$new_status."'"; ?>/>
     <input type="text" class="invisible" name="username_vol" <?php echo "value='".$username_vol."'"; ?>/>
     <input type="text" class="invisible" name="username_client" <?php echo "value='".$username_client."'"; ?>/>
     <input type="text" class="invisible" name="job_id" <?php echo "value='".$job_id."'"; ?>/>
     <label for="firstname" class="firstname_edit">Given Name: </label>
     <label for="firstname" class="lastname_edit">Surname: </label><br/>
     <input type="text" name="firstname" class="firstname_edit_input" required <?php echo "value='".$new_firstname."'"; ?> placeholder="Firstname"/>
     <input type="text" name="lastname" class="lastname_edit_input" required <?php echo "value='".$new_lastname."'"; ?> placeholder="Lastname"/>
     <label for="firstname" class="firstname_edit">Service: </label>
     <label for="language" class="lang_edit">Language: </label><br/>
     <select name="service" class="service_edit" required>
          <?php 
               $service_result_new = $db->select_all('service');
               foreach ($service_result_new as $line) {
                    if ($line['service_id'] == $new_service) {
                         echo '<option value="'.$line['service_id'].'" selected>'.$line['name'].'</option>';

                    } else {
                         echo '<option value="'.$line['service_id'].'">'.$line['name'].'</option>';  
                    }
               }
          ?>
     </select>
     <a id="add_pluse" data-reveal-id="myModal_service" href=""><div id="add_service_edit">+</div></a>
     <input type="text" name="language" id="language_edit"required  <?php echo "value='".$new_language."'"; ?>/>
     <a id="add_pluse" data-reveal-id="myModal_language" href=""><div id="add_service_edit">+</div></a><br/>
     <label for="contact_number" class="contact_number_edit_label">Contact Number: </label>
     <input type="text" name="contact_number" class="contact_number_edit"required <?php echo "value='".$new_contact_number."'"; ?>/><br />
     <label for="region" class="region_edit">Region: </label>
     <input type="text" name="region" id="region" required <?php echo "value='".$new_region."'"; ?>/><br />
     <label for="day" class="region_edit" class="region_edit">Preferred Day: </label><br />
     <div id="checkbox">
          <?php $preferred_day_old = explode(",", $new_preferred_day);
               $weekday_list = array('Mon', 'Tue','Wed','Thur','Fri','Sat','Sun');
               for ($i=1; $i < 8; $i++) { 
                    $checked = 0;
                    foreach ($preferred_day_old as $key) {
                         if ($key == ''.$i.'') {
                              echo '<input type="checkbox" id="'.($i-1).'" name="weekday[]" value="'.$i.'" checked><span class="checkbox_span">'.$weekday_list[$i - 1].'</span>';
                              $checked = 1;
                         }
                    }
                    if ($checked == 0) {
                         echo '<input type="checkbox" id="'.($i-1).'" name="weekday[]" value="'.$i.'"><span class="checkbox_span">'.$weekday_list[$i - 1].'</span>';
                    }
               }
          ?>
     </div><br />
     <label for="date" class="region_edit">Convenient Date: </label>
     <input class="datepicker" id="datepicker<?php echo "".$row['job_id'].""; ?>" type="text" name="date" id="date"required <?php echo "value='".$new_con_date."'"; ?>/><br />
     <label for="info" class="region_edit" >Service Details: </label><br />
     <textarea rows="6" cols="51" name="info" id="info" required ><?php echo $new_detail; ?></textarea><br />
     <input type="submit" name="submit_request" id="submit_request" value="Save" />
 </form>
<script>
  $(function() {
    $( "#datepicker<?php echo "".$row['job_id'].""; ?>" ).datepicker({ minDate: +1});
  });
</script>