<?php 
    include_once('php/global.inc');
?>

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
<body>
    <!--inlcude header-->
    <?php include('php/header_vol.inc'); ?>
    <section id="content">
        <div id="status">
            <div id="title">Status</div>

            <?php  
                include_once('class/DB.class.php');
                $number_requests = 0;
                $db = new DB();
                $db->connect();
                $result = $db->select('volunteer', 'username_vol = "'.$_SESSION['username'].'"');
                foreach ($result as $key ) {
                    $number_requests = $key['request'];
                }
                echo '<div id="request_number">You have '.$number_requests.' job(s) currently</div>';
                $result_requests = $db->select('job_pool', 'username_vol = "'.$_SESSION['username'].'" AND status < "4"');
                
                $index = 0;
                foreach($result_requests as $row) {

                    $index++;

                    // the pop-up window for send email
                    // echo '<div id="myModal_edit_'.$index.'" class="reveal-modal">
                    //     <div id="result-ajax">
                    //     <h2 id="error_message_email" class="error_red"></h2>
                    //      <h4>Send Message to: '.$row['firstname'].'</h4><br />';
                    //     include('php/email_form.php');
                    // echo '<a class="close-reveal-modal">&#215;</a>
                    //     </div>
                    // </div>';


                    echo '<div id="myModal_edit_'.$index.'" class="reveal-modal">
                    <div id="result-ajax-'.$index.'">
                        <h4>Send Message to: '.$row['firstname'].'</h4><br />
                        <h4 id="error_message_email_'.$index.'" class="error_red"></h4>';
                    include('php/email_form.php');

                    echo '</div>

                    <a class="close-reveal-modal">&#215;</a>        
                    </div>';




                    $service_name_result = $db->select('service', 'service_id = "'.$row['service'].'"');
                    foreach ($service_name_result as $key ) {
                        $service_name = $key['name'];
                    }

                    $language_name_result = $db->select('language', 'id = "'.$row['language'].'"');
                    foreach ($language_name_result as $key ) {
                        $languagee_name = $key['name'];
                    }

                    echo '<div class="quickFlip">'; // to flip the card of status to show details
                    echo '<div class="request_div">';
                    echo '<div class="request"><span class="quickFlipCta" id="handled_card">Request for '.$service_name.'<span></div>';
                    echo '<div class="request">Requested by: '.$row['firstname'].'</div>';
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
                    echo '<div id="confirm_salary" class="status">Received quotes</div>';
                    if ($row['status'] >= 3) {
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else {
                        echo '<img class="done" src="images/un_done.png" alt="done" width="50" />';
                    }
                    echo '<div id="confirm_offer" class="status">Service Confirmed</div>';
                    if ($row['status'] >= 4) {
                        echo '<img class="done" src="images/done.png" alt="done" width="50" />';
                    } else {
                        echo '<img class="done" src="images/un_done.png" alt="done" width="50" />';
                    }
                    echo '<div class="delete"><a href="php/cancel_job.php?keyword='.$row['job_id'].'">Cancel</a></div>';
                    echo '<div class="delete"><a href="edit_job.php?job_id='.$row['job_id'].'">Edit</a></div>';
                    echo '<div class="delete"><a href="quotes.php?keyword='.$row['job_id'].'">Quotes</a></div>';
                    echo '</div>';
                    echo '<div class="request_div" class="redPanel">';
                        echo '<table class="detail_card_table">

                            <tr>
                                <td class="card_left">Email:</td>
                                <td><a data-reveal-id="myModal_edit_'.$index.'" href="">'.$row['username_client'].'</a></td>
                            </tr>
                            <tr>
                                <td class="card_left">Client Name:</td>
                                <td>'.$row['firstname'].' '.$row['lastname'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Contact Number:</td>
                                <td>'.$row['number'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Language:</td>
                                <td>'.$languagee_name.'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Region:</td>
                                <td>'.$row['region'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Preferred Day:</td>
                                <td>'.$row['preferred_day'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Convenient Date:</td>
                                <td>'.$row['con_date'].'</td>
                            </tr>
                            <tr>
                                <td class="card_left">Detail:</td>
                                <td>'.$row['detail'].'</td>
                            </tr>
                        </table>';
                    echo '<div class="card_ok"><a class="quickFlipCta">OK</a></div>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </section>
</body>
<script type="text/javascript">
    $(function() {
        $('.quickFlip').quickFlip();
    });
</script>
<!--inlcude footer-->
<?php include('php/footer.inc'); ?>
</html>