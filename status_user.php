<?php 
    include_once('php/global.inc');
?>
<html class="user-page">
<head lang="en">
    <meta charset="UTF-8">
    <title>Migration</title>
    <!--link to css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <link rel="stylesheet" href="CSS/reveal.css" type="text/css" />
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

<body>
        <!--inlcude header-->
    <?php include('php/header_user.inc'); ?>
    <section id="content">
        <div id="title">Status</div>
        <?php  
                include_once('class/DB.class.php');
                $number_requests = 0;
                $db = new DB();
                $db->connect();
                $billed_result = $db->select_all('billed_period');
                $per_result = $db->select_all('rate');
                
                $result = $db->select('job_pool', 'username_client = "'.$_SESSION['username'].'"');
                foreach ($result as $key ) {
                    $number_requests++;
                } 
                echo '<div id="request_number">You have '.$number_requests.' request(s) sent currently</div>';
                $result_requests = $db->select('job_pool', 'username_client = "'.$_SESSION['username'].'"');
                foreach($result_requests as $row) { // show the requests for user
                    $service_name_result = $db->select('service', 'service_id = "'.$row['service'].'"');
                    $provider_result = $db->select('service_provider', 'service_id = "'.$row['service'].'"');

                    foreach ($service_name_result as $key ) {
                        $service_name = $key['name'];
                    }
                    $result_detail = $db->select('volunteer', 'username_vol = "'.$row['username_vol'].'"');

                    // the pop-up window for delete notification
                    echo '<div id="myModal_edit_'.$row['job_id'].'" class="reveal-modal">
                         <h2>Are you sure to delete this request?</h2><br />';
                    echo '<a class="yes" href="php/delete_request_user.php?keyword='.$row['job_id'].'">Yes</a>';
                    echo '<a class="yes" href="">No</a>';
                    echo '<a class="close-reveal-modal">&#215;</a>
                    </div>';

                    // the pop-up window for editting jobs
                    echo '<div id="myModal_edit_job_'.$row['job_id'].'" class="reveal-modal">
                         <h1>Edit Job Details:</h1>';
                         include('php/edit_form_user.php');
                    echo '<a class="close-reveal-modal">&#215;</a>
                    </div>';

                    // the pop-up window for check quote
                    
                    echo '<div id="myModal_quote_'.$row['job_id'].'" class="reveal-modal">';
                    echo '<div id="ajax-quote-accept-'.$row['job_id'].'">';
                    echo '
                        
                         <h1>Do you want to accept this quote:</h1>';
                         echo '<div class="quote_check">';
                         $quote_result = $db->select('quotes', 'job_id = "'.$row['job_id'].'" AND accept = "1"');
                         foreach ($quote_result as $key) {
                            $the_quote_id = $key['id'];

                            echo 'Service Provider:  ';
               foreach ($provider_result as $key_p) {
                    if ($key['provider_id'] == $key_p['id']) {
                         echo $key_p['name'];
                    }
               }
                    echo '<br />Setup Cost($):    '.$key['install_cost'].'';
                                   foreach ($per_result as $key_per) {
                                        if ($key['running_cost_per_id'] == $key_per['id']) {
                    echo '<br />Running Cost($):  '.$key['running_cost'].' per '.$key_per['rate'].'';
                    }
                                   }
                                   foreach ($billed_result as $bill) {
                                        if ($key['billed_id'] == $bill['id']) {
                    echo '<br />Billed period: '.$bill['period'].'';
                    }
                                   }
                    

                    $detail_provider = $db->select('service_provider', 'id = "'.$key['provider_id'].'"');  
                                   foreach ($detail_provider as $detail) {
                    echo '<br />Provider Telephone:      '.$detail['number'].'';
                    echo '<br />Provider Email:     '.$detail['email'].'';
                                   }
                    echo '<br />Extra information:<br /><div class="quote_info">'.$key['info'].'</div>';


                         }
                         echo '</div>';
                    echo '<div id="email_vol_'.$row['job_id'].'" class="invisible">'.$row['username_vol'].'</div>';
                    echo '<div class="accept_quote" onClick="accept_quote('.$row['job_id'].', '.$the_quote_id.');">Accept</div>';
                    echo '<div class="accept_quote" onClick="decline_quote('.$row['job_id'].', '.$the_quote_id.');">Decline</div></div>';
                    echo '<a class="close-reveal-modal">&#215;</a>
                    </div>';

                    
                    $service_name_result = $db->select('service', 'service_id = "'.$row['service'].'"');
                    foreach ($service_name_result as $key ) {
                        $service_name = $key['name'];
                    }
                    

                    echo '<div class="quickFlip">';
                    echo '<div class="request_div" class="blackaPanel">';
                    echo '<div class="request">Request for '.$service_name.'</div>';
                    echo '<div class="request">Handled by: <span class="quickFlipCta" id="handled_card">'.$row['username_vol'].'</span></div>';
                    echo '<div id="submit_form" class="status">Request Submitted</div>';
                    if ($row['status'] >= 1) {
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else {
                        echo '<img class="done" src="images/un_done.png" alt="done" width="50" />';
                    }
                    echo '<div id="handled" class="status">Handled by a volunteer</div>';
                    if ($row['status'] >= 2) {
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else {
                        echo '<img class="done" src="images/un_done.png" alt="done" width="50" />';
                    }
                    
                    if ($row['status'] == 3) {
                        echo '<div id="confirm_salary" class="status"><a data-reveal-id="myModal_quote_'.$row['job_id'].'" class="check_quote" href="">Received quotes</a></div>';
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else if ($row['status'] > 3) {
                        echo '<div id="confirm_salary" class="status">Received quotes</div>';
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else if ($row['status'] < 3) {
                        echo '<div id="confirm_salary" class="status">Received quotes</div>';
                        echo '<img class="done" src="images/un_done.png" alt="done" width="50" />';
                    }
                    echo '<div id="confirm_offer" class="status">Service Confirmed</div>';
                    if ($row['status'] >= 4) {
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else {
                        echo '<img class="done" src="images/un_done.png" alt="done" width="50" />';
                    }
                    echo '<div class="delete"><a data-reveal-id="myModal_edit_'.$row['job_id'].'" href="">Delete</a></div>';
                    echo '<div class="delete"><a data-reveal-id="myModal_edit_job_'.$row['job_id'].'" href="">Edit</a></div>';
                    echo '</div>';
                    echo '<div class="request_div" class="redPanel">';
                    $nothing = 0;
                    foreach($result_detail as $detail) {

                        // the pop-up window for send email
                        echo '<div id="myModal_email_'.$row['job_id'].'" class="reveal-modal">
                             <h4>Send Message to: '.$detail['firstname'].'</h4><br />';
                        include('php/email_form_client.php');
                        echo '<a class="close-reveal-modal">&#215;</a>
                        </div>';


                        $nothing++;
                        echo '<table class="detail_card_table">
                            <tr>
                                <td class="card_left">Email:</td>
                                <td><a data-reveal-id="myModal_email_'.$row['job_id'].'" href="">'.$detail['username_vol'].'</a></td>
                            </tr>
                            <tr>
                                <td class="card_left">Name:</td>
                                <td>'.$detail['firstname'].' '.$detail['lastname'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Contact Number:</td>
                                <td>'.$detail['number'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Language:</td>
                                <td>'.$detail['language'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Region:</td>
                                <td>'.$detail['region'].'</td>
                            </tr>
                        </table>';
                    }
                    if ($nothing == 0) { // show not handled
                        echo '<div class="waiting_still">Still waiting for someone may concern</div>';
                    }
                    echo '<div class="card_ok"><a class="quickFlipCta">OK</a></div>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
    </section>
</body>
<script type="text/javascript">
    $(function() {
        $('.quickFlip').quickFlip();
    });
</script>
        <!--include footer-->
<?php include('php/footer.inc'); ?>
</html>


