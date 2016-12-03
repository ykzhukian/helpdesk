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
    
</head>
<body>
    <!--include header-->
    <?php include('php/header_vol.inc'); ?>
    <section id="content">
        <div id="status">
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
                            $result_2 = $db->select_all_group('job_pool', 'language');
                            echo '<option value="all">All</option>';
                            foreach($result_2 as $row){
                                if ($_POST['by_language'] == $row['language']){
                                    echo '<option selected="selected" value="'.$row['language'].'">'.$row['language'].'</option>';
                                } else {
                                    echo '<option value="'.$row['language'].'">'.$row['language'].'</option>';
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
                    echo '<div id="take_failed">Already have 2 jobs to do.</div>';
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
                foreach($result_requests as $row) {
                    $card_num++;

                    // the pop-up window for editting jobs
                    echo '<div id="myModal_edit_'.$card_num.'" class="reveal-modal">
                         <h1>Edit Job Details:</h1>';
                         include('php/edit_form.php');
                    echo '<a class="close-reveal-modal">&#215;</a>
                    </div>';
                    $service_name_result = $db->select('service', 'service_id = "'.$row['service'].'"');
                    foreach ($service_name_result as $key ) {
                        $service_name = $key['name'];
                    }

                    // the stauts of each request
                    echo '<div class="request_div">';
                    echo '<table class="job_card">
                            <tr>
                                <td><div class="left">Request for:</div></td>
                                <td><div class="job_pool">'.$service_name.'</div></td>
                            </tr>
                            <tr>
                                <td><div class="left">Requested by:</div></td>
                                <td><div class="job_pool">'.$row['firstname'].'</div></td>
                            </tr>
                            <tr>
                                <td><div class="left">Language:</div></td>
                                <td><div class="job_pool">'.$row['language'].'</div></td>
                            </tr>
                            <tr>
                                <td><div class="left">Region:</div></td>
                                <td><div class="job_pool">'.$row['region'].'</div></td>
                            </tr>
                            <tr>
                                <td><div class="left">Convenient Date:</div></td>
                                <td><div class="job_pool">'.$row['con_date'].'</div></td>
                            </tr>
                            <tr>
                                <td><div class="job_pool">Details:</div></td>
                            </tr>

                        </table>';
                    echo '<div id="detail_jobpool">'.$row['detail'].'</div>';
                    echo '<div class="take"><a href="php/take_job.php?keyword='.$row['job_id'].'">Take</a></div>';
                    echo '<div class="take"><a data-reveal-id="myModal_edit_'.$card_num.'" href="#?keyword='.$row['job_id'].'">Edit</a></div>';
                    echo '<div class="take"><a data-reveal-id="myModal'.$card_num.'" href="#?keyword='.$row['job_id'].'">Assign to</a></div>';
                    echo '</div>';

                    // the pop-up window for assign jobs
                    echo '<div id="myModal'.$card_num.'" class="reveal-modal">
                         <h1>Assign the Job To:</h1>
                         <form method="POST" action="php/assign.php?job_id='.$row['job_id'].'">
                            <select class="job_assign_select" name="username" required>';
                                    $result_vols = $db->select_all('volunteer');
                                    echo '<option value="waiting">Please select a volunteer</option>';
                                    foreach($result_vols as $row){
                                        echo '<option value="'.$row['username_vol'].'">'.$row['firstname'].' '.$row['lastname'].' ('.$row['language'].')</option>';
                                    }
                                
                    echo    '</select>
                            <input type="submit" value="OK" class="job_assign_submit"/>
                         </form>
                         <a class="close-reveal-modal">&#215;</a>
                    </div>';


                }
                // show no result if there is no request
                if ($card_num == 0) {
                    echo '<div id="no_result">No Result</div>';
                }
            ?>
        </div>
    </section>
</body>
<?php include('php/footer.inc'); ?>
</html>