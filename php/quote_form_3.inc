<?php
     $billed_result = $db->select_all('billed_period');
     $per_result = $db->select_all('rate');
     $provider_result = $db->select('service_provider', 'service_id = "'.$service_id.'"');
     $client_result = $db->select('job_pool', 'job_id = "'.$_GET['keyword'].'"');

     foreach ($client_result as $r) {
          $client_email = $r['username_client'];
     }

     // foreach ($new_result as $key) {
     //      $username_vol = $key['username_vol'];
     // }
     $quote_result = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'" AND preference = "3"');
     foreach ($quote_result as $key) {
          $this_provider = $key['provider_id'];
          $this_id = $key['id'];
          $this_install = $key['install_cost'];
          $this_running = $key['running_cost'];
          $this_run_per = $key['running_cost_per_id'];
          $this_billed = $key['billed_id'];
          $this_status = $key['status'];
          $this_info = $key['info'];
          $date = $key['date'];
     }

     echo "<div id='date_quote' style='font-style: italic;'>Last Updated on ".$date."</div>";
?>

<form id="quote_form_3" class="quote_form" method="POST" action="php/update_quote.php">
     <span class="preferred_quote"><b>Set as Preferred: </b></span><input type="checkbox" id="preferred3" name="preferred" value="10"><br />
     <input class="invisible" type="text" name="preference" value="3" />
     <input class="invisible" type="text" name="id" <?php echo 'value="'.$this_id.'"'; ?> />
     <input class="invisible" type="text" name="job_id" <?php echo 'value="'.$_GET['keyword'].'"'; ?> />
     <label for="provider" class="provider">Service Provider: </label>
     <select name="provider_id" class="quote_select" id="provider_disable3">
          <?php
               foreach ($provider_result as $key) {
                    if ($this_provider == $key['id']) {
                         echo '<option value="'.$key['id'].'" selected>'.$key['name'].'</option>';
                    } else {
                         echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
                    }
               }
          ?>
     </select>

     <label for="quote_status" class="quote_status">Status: </label>
     <select name="status" class="quote_select" id="status_disable3">
          <?php 
               if ($this_status == 1) {
                    echo '<option value="1" selected>Contact the provider</option>
                         <option value="2">Awaiting Quote</option>
                         <option value="3">Quote Recorded</option>';
               } else if ($this_status == 2){
                    echo '<option value="1">Contact the provider</option>
                         <option value="2" selected>Awaiting Quote</option>
                         <option value="3">Quote Recorded</option>';    
               } else if ($this_status == 3){
                    echo '<option value="1">Contact the provider</option>
                         <option value="2" >Awaiting Quote</option>
                         <option value="3" selected>Quote Recorded</option>';    
               }

          ?>
     </select><br />
     <?php
          $detail_provider = $db->select('service_provider', 'id = "'.$this_provider.'"');
          foreach ($detail_provider as $key) {
               echo '<div class="service_provider_info">Telephone: '.$key['number'].'</div>';
               // echo '<div class="email_quotes">Email: '.$key['email'].'</div>';
               // echo '<div class="email_quotes">Link: '.$key['link'].'</div>';
          }
     ?>
     <div id="install_label" for="install">Install (base) Cost: $</div>
     <input type="text" name="install" id="install3" required placeholder="Installation Cost" <?php echo "value='".$this_install."'"; ?> /><br/>
     <?php
          $detail_provider = $db->select('service_provider', 'id = "'.$this_provider.'"');
          foreach ($detail_provider as $key) {
               // echo '<div>Telephone: '.$key['number'].'</div>';
               echo '<div class="email_quotes">Email: '.$key['email'].'</div>';
               // echo '<div class="email_quotes">Link: '.$key['link'].'</div>';
          }
     ?>
     <label for="running">Running Cost: $</label>
     <input type="text" name="running" id="running3" required placeholder="Running Cost" <?php echo "value='".$this_running."'"; ?>/>
     <label for="quote_status" class="quote_status">per</label>
     <select name="period" class="quote_select" id="per_disable3">
          <?php
               foreach ($per_result as $key) {
                    if ($this_run_per == $key['id']) {
                         echo '<option value="'.$key['id'].'" selected>'.$key['rate'].'</option>';
                    } else {
                         echo '<option value="'.$key['id'].'">'.$key['rate'].'</option>';
                    }
               }
          ?>
     </select>
     <label for="quote_status" class="quote_status">Billed: </label>
     <select name="billed" class="quote_select" id="billed_disable3">
          <?php
               foreach ($billed_result as $key) {
                    if ($this_billed == $key['id']) {
                         echo '<option value="'.$key['id'].'" selected>'.$key['period'].'</option>';
                    } else {
                         echo '<option value="'.$key['id'].'">'.$key['period'].'</option>';    
                    }
               }
          ?>
          
     </select><br/>
     <label for="info" class="info">Extra Information: </label><br />
     <textarea rows="6" cols="80" name="info" id="info3" required placeholder="Type Here"  ><?php echo $this_info; ?></textarea><br />

     <div  id="quote_send3"><a data-reveal-id="myModal_3">Notify Client</a></div>
     
     <input type="submit" name="update_quote" id="quote_update3" value="Update"/>
     <div type="button" name="edit_quote" id="quote_edit3" value="Edit" onClick="enableInput(3);">Edit</div>
 </form>

<!--send quote to client-->
<div id="myModal_3" class="reveal-modal">
     <div id="ajax-quote-email-3">
          <h2 id='error_message_send_quote3' class='error_red'></h2>
          <h2 class="send_title_h">Contact Client</h2>
          <form id="send_quote_3">
          <label for="email" class="send_title_lb">Email:</label>
          <input id="quote_email_3" class="send_title" type="text" name="email_address" required <?php echo 'value="'.$client_email.'"' ?>/>
          <input id="quote_id_3" class="invisible" type="text" required <?php echo 'value="'.$this_id.'"' ?>/>
          <input id="job_id_3" class="invisible" type="text" required <?php echo 'value="'.$_GET['keyword'].'"' ?>/>
          <label for="title" class="send_title_lb">Title:</label>
          <input id="quote_title_3" type="text" name="title" class="send_title" required value="Best quote for your request"/><br /><br />
          <textarea id="quote_info_3" rows="10" cols="60" name="quote_detail" required placeholder="Type Here"  ><?php 
echo 'Service Provider:  ';
               foreach ($provider_result as $key_p) {
                    if ($this_provider == $key_p['id']) {
                         echo $key_p['name'];
                    }
               }
echo '

Setup Cost($):      '.$this_install.'';
               foreach ($per_result as $key_per) {
                    if ($this_run_per == $key_per['id']) {
echo '

Running Cost($):    '.$this_running.' per '.$key_per['rate'].'';
}
               }
               
               foreach ($detail_provider as $key) {
echo '

Provider Telephone:      '.$key['number'].'';
echo '

Provider Email:     '.$key['email'].'';
               }
echo '

Extra information: 
               '.$this_info.'';



          ?>
          </textarea><br />
          <input type="button" class="send_quote_submit" value="Message client" onClick="send_quote_email(3);"/>       
          </form>

     </div>
     <a class="close-reveal-modal">&#215;</a>        
</div>