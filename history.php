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
    <script src="javascript/myjs.js"></script>



</head>
<body>
    <!--include header-->
    <?php include('php/header_vol.inc'); ?>
    <section id="content">
            <!--title-->
            <div id="title">Finished Jobs</div>

            <?php
                include_once('class/DB.class.php');
                $number_requests = 0; // count the requests number
                $db = new DB(); // link to db
                $db->connect();
                
            ?>
            
            <?php

                $result_requests = $db->select('job_pool', 'status = "4"');

                $card_num = 0;
                foreach ($result_requests as $key ) { //count requests
                    $number_requests++;
                }
                echo '<br/><div id="request_number">There are '.$number_requests.' job(s) Finished</div>';

                //job list start
                echo '<div id="job_list">';
                echo '<table id="job_list_table">
                            <tr>
                                <td></td>
                                <td><div class="job_list_title">Service</div></td>
                                <td><div class="job_list_title">Requester</div></td>
                                <td><div class="job_list_title">Language</div></td>
                                <td><div class="job_list_title">Region</div></td>
                                <td><div class="job_list_title">Convenient Date</div></td>
                                
                            </tr>';

                foreach($result_requests as $row) {
                    $card_num++;

                    $service_name_result = $db->select('service', 'service_id = "'.$row['service'].'"');
                    foreach ($service_name_result as $key ) {
                        $service_name = $key['name'];
                    }

                    $language_name_result = $db->select('language', 'id = "'.$row['language'].'"');
                    foreach ($language_name_result as $key ) {
                        $languagee_name = $key['name'];
                    }
         
                    echo '<tr onclick="display_detail_jobpool('.$card_num.');" class="job_pool_hover">
                                <td><img id="plus_'.$card_num.'" src="images/plus.png" alt="plus" width="15" /></td>
                                <td><div class="job_list_row">'.$service_name.'</div></td>
                                <td><div class="job_list_row">'.$row['firstname'].'</div></td>
                                <td><div class="job_list_row">'.$languagee_name.'</div></td>
                                <td><div class="job_list_row">'.$row['region'].'</div></td>
                                <td><div class="job_list_row">'.$row['con_date'].'</div></td>
                            </tr>';
                    // echo '<div class="take"><a href="php/take_job.php?keyword='.$row['job_id'].'">Take</a></div>';
                    // echo '<div class="take"><a data-reveal-id="myModal_edit_'.$card_num.'" href="#?keyword='.$row['job_id'].'">Edit</a></div>';
                    
                    // echo '</div>';
                    echo '<tr id="hide_'.$card_num.'" style="display: none;" class="detail_row">
                                <td></td>
                                <td><div class="job_list_row"  >Detail:</div></td>
                                <td class="job_list_detail" colspan="4"><p class="detail_break">'.$row['detail'].'</p></td>
                                
                            </tr>';

                }
                echo '</table>';
                
                // show no result if there is no request
                if ($card_num == 0) {
                    echo '<div id="no_result">No Result</div>';
                }
                echo '</div>';
            ?>
    </section>
</body>
<?php include('php/footer.inc'); ?>
</html>