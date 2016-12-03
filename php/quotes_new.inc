<?php
     $billed_result = $db->select_all('billed_period');
     $per_result = $db->select_all('rate');
     $provider_result = $db->select('service_provider', 'service_id = "'.$service_id.'"');
     // foreach ($new_result as $key) {
     //      $username_vol = $key['username_vol'];
     // }
?>

<form id="quote_form_new" method="POST" action="php/record_quote.php">
     <input class="invisible" name="job_id" type="text" <?php echo 'value="'.$_GET['keyword'].'"'; ?>/>
     <label for="provider" class="provider">Service Provider: </label>
     <select name="provider_id" class="quote_select">
          <?php
               foreach ($provider_result as $key) {
                    echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
               }
          ?>
     </select><br />

     <label for="quote_status" class="quote_status_pop">Status: </label>
     <select class="quote_select_pop">
          <option value="1">Contact the provider</option>
          <option value="2">Awaiting Quote</option>
          <option value="3">Quote Recorded</option>
     </select><br/>
     <label for="install">Install (base) Cost: $</label>
     <input type="text" name="install" id="install_pop" required placeholder="Installation Cost"/><br/>
     <label for="install">Running Cost: $</label>
     <input type="text" name="running" id="running_pop" required placeholder="Running Cost"/>
     <label for="quote_status" class="quote_status">per</label>
     <select name="period" class="quote_select">
          <?php
               foreach ($per_result as $key) {
                    echo '<option value="'.$key['id'].'">'.$key['rate'].'</option>';
               }
          ?>
     </select><br/>
     <label for="quote_status" class="quote_status_pop">Billed: </label>
     <select name="billed" class="quote_select_pop">
          <?php
               foreach ($billed_result as $key) {
                    echo '<option value="'.$key['id'].'">'.$key['period'].'</option>';
               }
          ?>
          
     </select><br/>
     <label for="info" class="info_pop">Extra Information: </label><br />
     <textarea rows="6" cols="58" name="info" id="info" required placeholder="Type Here"  ></textarea><br />
     <input type="submit" name="update_quote" id="quote_ok" value="OK" />
 </form>