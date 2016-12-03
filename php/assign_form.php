<h1 class="header_search">Assign the Job To:</h1>
 <form>
    <input <?php echo 'id="search'.$row['job_id'].'"' ?>  class="search" name = "search" type="text" placeholder=" Search for volunteer"/>
    <input class="search_button" type="button" value="Search" <?php echo 'onClick="searchResult('.$row['job_id'].');"' ?> ><br/>
    <label for="search_language" class="label_search">Language</label>
    <select <?php echo 'id="search_language'.$row['job_id'].'"' ?> class="search_language" name="search_language">
        <option value="all">All</option>
        <?php
            $languages = $db->select_all_group('volunteer', 'language');
            foreach ($languages as $key) {
                echo '<option value="'.$key['language'].'">'.$key['language'].'</option>';
            }
        ?>

    </select>
    <label for="search_region" class="label_search">Region</label>
    <select <?php echo 'id="search_region'.$row['job_id'].'"' ?> class="search_region" name="search_region">
        <option value="all">All</option>
        <?php
            $regions = $db->select_all_group('volunteer', 'region');
            foreach ($regions as $key) {
                echo '<option value="'.$key['region'].'" >'.$key['region'].'</option>';
            }
        ?>
    </select>
    <div id="search-ajax<?= $row['job_id'] ?>" >
        <?php include('search_result.php'); ?>
    </div>
</form>
<form id="assign_result_form" method="POST" <?php echo 'action="../site/php/assign.php?job_id='.$row['job_id'].'" onsubmit="return validation_assign('.$row['job_id'].');"';  ?> >
    <input <?php echo 'id="assign_result_email_'.$row['job_id'].'"'; ?> name="assign_result_email" class="invisible" type="text" required value="0"/>
    <div <?php echo 'id="error_'.$row['job_id'].'"'; ?> class="error_select"></div>
    <input id="assign_confirm_button" class="search_button" name="submit<?= $row['job_id']?>>" type="submit" value="Assign"><br/>
</form>