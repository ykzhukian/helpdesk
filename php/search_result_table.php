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
            foreach ($volunteers_list as $key) {
                $vol_number++;
                echo '<div class="result_row_search" onClick="selectVol('.$vol_number.', '.$row['job_id'].');" id="vol_row_'.$vol_number.'_'.$row['job_id'].'">
                        
                        <div id="vol_assign_email_'.$vol_number.'" style="display:none;">'.$key['username_vol'].'</div>
                        <div class="result_row">'.$key['firstname'].' '.$key['lastname'].'</div>
                        <div class="result_row">'.$key['region'].'</div>
                        <div class="result_row">'.$key['language'].'</div>
                        <div class="result_row">'.$key['request'].'</div>

                    </div>
                ';
            }
            if ($vol_number == 0) {
                echo '<div><div colspan="4">No Result</div></div>';
            }
        ?>