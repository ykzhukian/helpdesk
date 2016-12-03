<?php
    if (isset($_GET['job_id'])) {
        include_once('../class/DB.class.php');
    } else {
        include_once('class/DB.class.php');
    }
    
    $db = new DB(); // link to db
    $db->connect();
    $name = null;
    $search_language = 0;
    $search_region = 0;
    $job_id_search = 0;
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
    }
    if (isset($_GET['search_language'])) {
        $search_language = $_GET['search_language'];
    }
    if (isset($_GET['search_region'])) {
        $search_region = $_GET['search_region'];
    }
    if (isset($_GET['job_id'])) {
        $job_id_search = $_GET['job_id'];
    }

    

?>

    <div class="result_title_row">
        <div class="result_title"><b>Name</b></div>
        <div class="result_title"><b>Region</b></div>
        <div class="result_title"><b>Language</b></div>
        <div class="result_title"><b>Current Jobs</b></div>
    </div>
    <?php
        if ($search_language == "all" && $search_region == "all" && $name == null){
            $volunteers_list = $db->select_all('volunteer');
        } else if ($search_language != "all" && $search_region == "all" && $name == null) {
            $volunteers_list = $db->select('volunteer', 'language = "'.$search_language.'"');

        } else if ($search_language != "all" && $search_region != "all" && $name == null) {
            $volunteers_list = $db->select('volunteer', 'language = "'.$search_language.'" AND region = "'.$search_region.'"');

        } else if ($search_language == "all" && $search_region != "all" && $name == null) {
            $volunteers_list = $db->select('volunteer', 'region = "'.$search_region.'"');
        } else if ($name != null) {
            if ($search_language == "all" && $search_region == "all") {
                $volunteers_list = $db->select('volunteer', 'firstname like "%'.$name.'%" OR lastname like "%'.$name.'%"');
            } else if ($search_language != "all" && $search_region == "all") {
                $volunteers_list = $db->select('volunteer', '(firstname like "%'.$name.'%" OR lastname like "%'.$name.'%") AND language = "'.$search_language.'"');
            } else if ($search_language != "all" && $search_region != "all") {
                $volunteers_list = $db->select('volunteer', '(firstname like "%'.$name.'%" OR lastname like "%'.$name.'%") AND language = "'.$search_language.'" AND region = "'.$search_region.'"');
            } else if ($search_language == "all" && $search_region != "all") {
                $volunteers_list = $db->select('volunteer', '(firstname like "%'.$name.'%" OR lastname like "%'.$name.'%") AND region = "'.$search_region.'"');
            }
        }
        
        $vol_number = 0;
        $count = 0;
        foreach ($volunteers_list as $key) {
            $count++;
        }
        foreach ($volunteers_list as $key) {
            $vol_number++;
            if (isset($_GET['job_id'])) {
                echo '<div class="result_row_search" onClick="selectVol('.$vol_number.', '.$job_id_search.', '.$count.');" id="vol_row_'.$vol_number.'_'.$job_id_search.'">';
            } else {
                echo '<div class="result_row_search" onClick="selectVol('.$vol_number.', '.$row['job_id'].', '.$count.');" id="vol_row_'.$vol_number.'_'.$row['job_id'].'">';
            }
                    
            echo '  <div id="vol_assign_email_'.$vol_number.'" style="display:none;">'.$key['username_vol'].'</div>
                    <div class="result_row">'.$key['firstname'].' '.$key['lastname'].'</div>
                    <div class="result_row">'.$key['region'].'</div>
                    <div class="result_row">'.$key['language'].'</div>
                    <div class="result_row">'.$key['request'].'</div>

                </div>
            ';
        }
        if ($vol_number == 0) {
            echo '<div class="no_result">No Result</div>';
        }
    ?>




