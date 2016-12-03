<?php 
    include_once('php/global.inc');
    if (!isset($_POST['by_language'])) {
        $_POST['by_language'] = "all";
    }
    if (!isset($_POST['by_region'])) {
        $_POST['by_region'] = "all";
    }
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
    <script src="javascript/myjs.js"></script>
    <script src="javascript/date-picker.js"></script>
    <script src="javascript/date-picker-ui.js"></script>
    <script src="javascript/ajax.js"></script>

</head>
<body>
    <!--include header-->
    <?php include('php/header_vol.inc'); ?>
    <section id="content">
            <!--title-->
            <div id="title">Unassigned Jobs</div>

            <?php
                include_once('class/DB.class.php');
                $number_requests = 0; // count the requests number
                $db = new DB(); // link to db
                $db->connect();
                
            ?>
            <!--form used to choose sort the request by language or region-->
            <form id="sorted_by" method="POST" action="jobpool.php">
                    <label for="by_language" id="language_label">Language:</label>
                    <select d="by_language" name="by_language">
                        <?php 
                            $result_2 = $db->select_all('language');
                            echo '<option value="all">All</option>';
                            foreach($result_2 as $row){
                                if ($_POST['by_language'] == $row['id']){
                                    echo '<option selected="selected" value="'.$row['id'].'">'.$row['name'].'</option>';
                                } else {
                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <label for="by_region" id="region_label">Region:</label>
                    <select d="by_region" name="by_region">
                        <?php 
                            $result_3 = $db->select_all_group('job_pool', 'region');
                            echo '<option value="all">All</option>';
                            foreach($result_3 as $row){
                                if ($_POST['by_region'] == $row['region']){
                                    echo '<option selected="selected" value="'.$row['region'].'">'.$row['region'].'</option>';
                                } else {
                                    echo '<option value="'.$row['region'].'">'.$row['region'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <input type="submit" name="card_submit" id="card_submit" value="OK" />
            </form>
            
            <?php
                if (isset($_GET['sorry'])) { // error recorded
                    echo '<div id="take_failed"><h2>Already have 2 jobs to do.</h2></div>';
                }
                // to group the requests by language or by region
                if ($_POST['by_language'] == "all" && $_POST['by_region'] == "all") {
                    $result_requests = $db->select('job_pool', 'username_vol = "waiting"');
                } else if ($_POST['by_language'] != "all" && $_POST['by_region'] == "all") {
                    $result_requests = $db->select('job_pool', 'username_vol = "waiting" AND language = "'.$_POST['by_language'].'"');
                } else if ($_POST['by_language'] == "all" && $_POST['by_region'] != "all") {
                    $result_requests = $db->select('job_pool', 'username_vol = "waiting" AND region = "'.$_POST['by_region'].'"');
                } else {
                    $result_requests = $db->select('job_pool', 'username_vol = "waiting" AND language = "'.$_POST['by_language'].'" AND region = "'.$_POST['by_region'].'" ');
                }
                $card_num = 0;
                foreach ($result_requests as $key ) { //count requests
                    $number_requests++;
                }
                echo '<br/><div id="request_number">There are '.$number_requests.' job(s) ready to be assigned</div>';

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

                    // the pop-up window for editting jobs
                    // echo '<div id="myModal_edit_'.$card_num.'" class="reveal-modal">
                    //      <h1>Edit Job Details:</h1>';
                    //      include('php/edit_form.php');
                    // echo '<a class="close-reveal-modal">&#215;</a>
                    // </div>';


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
                                <td class="job_list_detail" colspan="2"><p class="detail_break">'.$row['detail'].'</p></td>
                                <td><div class="take"><a href="php/take_job.php?keyword='.$row['job_id'].'">Take</a></div></td>
                                <td><div class="take"><a data-reveal-id="myModal'.$card_num.'" href="#?keyword='.$row['job_id'].'">Assign to</a></div></td>
                            </tr>';



                    // the pop-up window for assign jobs
                    echo '<div id="myModal'.$card_num.'" class="reveal-modal">';
                    include('php/assign_form.php');
                    echo '<a class="close-reveal-modal">&#215;</a>
                    </div>';

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