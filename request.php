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
    <?php include('php/header_user.inc'); ?>
    <section id="content">
        <div id="request">
            <div id="title">New Request</div>
                <form id="service_name" action="request.php" method="POST">
                    <label for="name">Which service do you need: </label>
                    <select name="name" id="name">
                        <?php // link to db
                            include_once('class/DB.class.php');
                            $db = new DB();
                            $db->connect();
                            $result = $db->select_all('service');
                            foreach($result as $row){
                                if ($_POST['name'] == $row['name']){
                                    echo '<option selected="selected" value="'.$row['name'].'">'.$row['name'].'</option>';
                                } else {
                                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <input type="submit" name="submit_name" id="submit_name" value="OK" />
                    <a id="add_pluse" data-reveal-id="myModal" href=""><div id="add_service_plus">+</div></a>
                    
                </form>

                <?php     
                    if (isset($_GET['error'])) { // check duplicated error
                                echo "<div id='take_failed'>Service exists</div>";
                    }              
                    // send the value to the form
                    if (isset($_POST['name']) && !isset($_POST['language'])) {
                        $result_2 = $db->select('client', 'username = "'.$_SESSION['username'].'"');
                        foreach($result_2 as $row){
                            $service = $_POST['name'];
                            $username = $row['username'];
                            $firstname = $row['firstname'];
                            $lastname =$row['lastname'];
                            $language = $row['language'];
                            $region = $row['region'];
                            $number = $row['number'];
                        }
                        echo '<div id="title">Request Details</div>';
                        include('php/request_form.inc');
                    } else if (isset($_POST['language'])) {
                        // include 'php/inset_new_request.inc';
                        $service_id_result = $db->select('service', 'name = "'.$_POST['service'].'"');
                        foreach($service_id_result as $row){
                            $service_id = $row['service_id'];
                        }  // add a new row into db as a new request
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

    </section>
</body>
<!--include footer-->
<?php include('php/footer.inc'); ?>
</html>