<html class="user-page">
<head lang="en">
    <meta charset="UTF-8">
    <title>Migration</title>
    <!--link to css-->
    <link rel="stylesheet" href="CSS/reveal.css" type="text/css" />
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <link rel="stylesheet" href="CSS/date-picker.css" type="text/css"/>
    <!--link to js-->
    <script src="javascript/jquery.min.js" type="text/javascript"></script>
    <script src="javascript/jquery.reveal.js" type="text/javascript"></script>
    <script src="javascript/date-picker.js"></script>
    <script src="javascript/date-picker-ui.js"></script>
    <script src="javascript/jquery.quickflip.source.js" type="text/javascript"></script>
    <script src="javascript/myjs.js"></script>
    <script src="javascript/ajax.js"></script>



</head>
<?php

     include_once('php/global.inc');
     include_once('class/DB.class.php');
     $db = new DB();
     $db->connect();
     $new_result = $db->select('job_pool', 'job_id = "'.$_GET['job_id'].'"');
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
<body>
    <!--inlcude header-->
    <?php include('php/header_vol.inc'); ?>
    <section id="content">
            <div id="title">Edit Job Detail</div>
            <div id="edit_job_card">
              <form id="edit_form" method="POST" action="php/edit_detail.php">
                   <input type="text" class="invisible" name="status" <?php echo "value='".$new_status."'"; ?>/>
                   <input type="text" class="invisible" name="username_vol" <?php echo "value='".$username_vol."'"; ?>/>
                   <input type="text" class="invisible" name="username_client" <?php echo "value='".$username_client."'"; ?>/>
                   <input type="text" class="invisible" name="job_id" <?php echo "value='".$job_id."'"; ?>/>
                   <label for="firstname" class="firstname_edit">Given Name: </label>
                   <label for="firstname" class="lastname_edit">Surname: </label><br/>
                   <input type="text" name="firstname" class="firstname_edit_input" required <?php echo "value='".$new_firstname."'"; ?> placeholder="Firstname"/>
                   <input type="text" name="lastname" class="lastname_edit_input" required <?php echo "value='".$new_lastname."'"; ?> placeholder="Lastname"/><br />
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
                   <a id="add_pluse" data-reveal-id="myModal" href=""><div id="add_service_edit">+</div></a>
                   <select name="language" class="service_edit" required>
                        <?php 
                             $language_result_new = $db->select_all('language');
                             foreach ($language_result_new as $lang) {
                                  if ($lang['id'] == $new_language) {
                                       echo '<option value="'.$lang['id'].'" selected>'.$lang['name'].'</option>';

                                  } else {
                                       echo '<option value="'.$lang['id'].'">'.$lang['name'].'</option>';  
                                  }
                             }
                        ?>
                   </select>

                   <a id="add_pluse" data-reveal-id="myModal_add_language" href=""><div id="add_service_edit">+</div></a><br/>
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
                   <input class="datepicker" id="datepicker" type="text" name="date" id="date"required <?php echo "value='".$new_con_date."'"; ?>/><br />
                   <label for="info" class="region_edit" >Service Details: </label><br />
                   <textarea rows="6" cols="51" name="info" id="info" required ><?php echo $new_detail; ?></textarea><br />
                   <input type="submit" name="submit_request" id="submit_request" value="Save" />
                   <input type="button" id="cancel_request" value="Cancel" onclick="window.location.href='status_vol.php'"/>
               </form>
            </div>

               <!--pop up window to add new service-->
        <div id="myModal" class="reveal-modal">
            <div id="result-ajax">
          <h2 id='error_message' class='error_red'></h2>
                <form id="new_service">
                    <label for="service_name" id="add_service_label">Add a new service to the list:</label>
                    <input type="text" name="new_service_name" id="new_service_name" required />
                    <input type="button" name="new_service_submit" id="new_service_submit" value="Add" onClick="add_service();"/>       
                </form>
            </div>

            <a class="close-reveal-modal">&#215;</a>        
        </div>
        
        <!--pop up window to add new language-->
        <div id="myModal_add_language" class="reveal-modal">
            <div id="language-ajax">
            <h2 id='error_message_language' class='error_red'></h2>
                <form id="new_language">
                    <label for="service_name" id="add_service_label">Add a new language to the list:</label>
                    <input type="text" name="new_language_name" id="new_language_name" required />
                    <input type="button" name="new_language_submit" id="new_language_submit" value="Add" onClick="add_language();"/>       
                </form> 
            </div>

            <a class="close-reveal-modal">&#215;</a>        
</div>
</section>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: +1});
  });
</script>
<?php include('php/footer.inc'); ?>
