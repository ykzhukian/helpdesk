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
    <script src="javascript/myjs.js"></script>
    <script src="javascript/date-picker.js"></script>
    <script src="javascript/date-picker-ui.js"></script>
    <script src="javascript/ajax.js"></script>
    
</head>

<body>
    <!--inlcude header-->
    <?php include('php/header_vol.inc'); ?>
    <section id="content">
        <div id="request">
            <div id="title">New Request</div>
                <?php include('php/service_form.php'); ?>
                <div id="add_service_button"><a data-reveal-id="myModal_provider" href=""> + Add a new service provider</a></div>

                
                <?php 
                    if (isset($_GET['error'])) {
                                echo "<div id='take_failed'>Service exists</div>";
                        }
                
                    if (isset($_POST['name']) && !isset($_POST['language'])) {
                        $service = $_POST['name'];
                        echo '<div id="title">Request Details</div>';
                        include('php/request_form_vol.inc');
                    } else if (isset($_POST['language'])) {
                        // include 'php/inset_new_request.inc';

                        $service_id_result = $db->select('service', 'name = "'.$_POST['service'].'"');
                        foreach($service_id_result as $row){
                            $service_id = $row['service_id'];
                        }
                        $data = array(
                            "service" => json_encode($service_id),
                            "username_client" => json_encode($_POST['username']),
                            "username_vol" => json_encode('waiting'),
                            "firstname" => json_encode($_POST['firstname']),
                            "lastname" => json_encode($_POST['lastname']),
                            "language" => json_encode($_POST['language']),
                            "region" => json_encode($_POST['region']),
                            "number" => json_encode($_POST['contact_number']),
                            "detail" => json_encode($_POST['info']),
                            "preferred_day" => json_encode(implode(',', $_POST['weekday'])),
                            "con_date" => json_encode($_POST['date']),
                            "status" => 1
                        );
                        $db->insert($data, 'job_pool');
                        echo '<br/>';
                        echo "<div>You have sent a new request.</div>";
                    }
                ?>
        </div>
        <!--pop up window to add new service-->
        <div id="myModal" class="reveal-modal">
            <div id="result-ajax">
                <h2 id='error_message' class='error_red'></h2>
                <form id="new_service">
                    <label for="service_name" id="add_service_label">Add a new service to the list:</label>
                    <input type="text" name="new_service_name" id="new_service_name" required />
                    <input type="button" name="new_service_submit" id="new_service_submit" value="Add" onClick="add_service();"/>       
                </form>
            </div>

            <a class="close-reveal-modal">&#215;</a>        
        </div>


        <!--pop up window to add new language-->
        <div id="myModal_add_language" class="reveal-modal">
            <div id="language-ajax">
                <h2 id='error_message_language' class='error_red'></h2>
                <form id="new_language">
                    <label for="service_name" id="add_service_label">Add a new language to the list:</label>
                    <input type="text" name="new_language_name" id="new_language_name" required />
                    <input type="button" name="new_language_submit" id="new_language_submit" value="Add" onClick="add_language();"/>       
                </form> 
            </div>

            <a class="close-reveal-modal">&#215;</a>        
        </div>



        <!--pop up window to add new serivce providers-->
        <div id="myModal_provider" class="reveal-modal">
            <form id="new_service_provider" method="POST" action="php/insert_new_service_provider.php">
                <label for="name" id="add_service_label">Provider Name:</label>
                <input type="text" name="provider_name" id="provider_name" required /><br />
                <label for="service" id="add_service_label">Service Type:</label>
                <select name="service" id="name">
                        <?php
                            $result_10 = $db->select_all('service');
                            foreach($result_10 as $row){
                                if ($_POST['name'] == $row['name']){
                                    echo '<option selected="selected" value="'.$row['service_id'].'">'.$row['name'].'</option>';
                                } else {
                                    echo '<option value="'.$row['service_id'].'">'.$row['name'].'</option>';
                                }
                            }
                        ?>
                </select><br />
                <label for="number" id="add_service_label">Contact Number:</label>
                <input type="text" name="number" id="provider_name" required /><br />
                <label for="email" id="add_service_label">Email:</label>
                <input type="text" name="email" id="provider_name" required /><br />
                <label for="link" id="add_service_label">Link:</label>
                <input type="text" name="link" id="provider_name" required /><br />
                <input type="submit" name="new_service_submit" id="provider_add" value="Add" />       
            </form> 
            <a class="close-reveal-modal">&#215;</a>        
        </div>
    </section>
</body>
<!--inlcude footer-->
<?php include('php/footer.inc'); ?>
</html>