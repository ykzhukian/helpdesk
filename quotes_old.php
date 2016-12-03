<?php 
    include_once('class/DB.class.php');
    include_once('php/global.inc');
    $db = new DB();
    $db->connect();

?>

<html class="user-page">
<head lang="en">
    <meta charset="UTF-8">
    <title>Migration</title>
    <!--link to css-->
    <link rel="stylesheet" href="CSS/reveal.css" type="text/css" />
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <link rel="stylesheet" href="CSS/jquery-ui.css" type="text/css" />
    <!--link to js-->
    <script src="javascript/jquery.js" type="text/javascript"></script>
    <script src="javascript/jquery.min.js" type="text/javascript"></script>
    <script src="javascript/jquery.reveal.js" type="text/javascript"></script>
    <script src="javascript/myjs.js"></script>
    <script src="javascript/jquery-ui.js"></script>
</head>

<!--js functino for drag the tabs-->
<script>
    $(function() {
        var tabs = $( "#tabs" ).tabs();
        tabs.find( ".ui-tabs-nav" ).sortable({
            axis: "x",
            stop: function() {
                tabs.tabs( "refresh" );
            }
        });
    });
</script>

<body>
    <?php 
        include('php/header_vol.inc'); 
        $job_result = $db->select('job_pool', 'job_id = "'.$_GET['keyword'].'"');
        foreach ($job_result as $key) { 
            $service_id = $key['service'];
        }
    ?>
    <section id="content">
        <div id="quotes">
            <div id="title">Quotes</div>
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">First</a></li>
                    <li><a href="#tabs-2">Second</a></li>
                    <li><a href="#tabs-3">Third</a></li>
                </ul>
                <!--three seperate tabs for three quotes-->
                <?php 
                    $quotes = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'"');
                    $counter = 0;
                    foreach ($quotes as $key) {
                        $counter++;
                    }
                    if ($counter == 0) {
                        echo '<div class="quotes" id="tabs-1">';
                        echo '<div id="add_service_button"><a data-reveal-id="myModal" href=""> + Record a new quote</a></div>';
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-2">';
                        echo '<div id="add_service_button"><a data-reveal-id="myModal" href=""> + Record a new quote</a></div>';
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-3">';
                        echo '<div id="add_service_button"><a data-reveal-id="myModal" href=""> + Record a new quote</a></div>';
                        echo '</div>';
                    } else if ($counter == 1){
                        echo '<div class="quotes" id="tabs-1">';
                            include('php/quote_form_1.inc'); 
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-2">';
                        echo '<div id="add_service_button"><a data-reveal-id="myModal" href=""> + Record a new quote</a></div>';
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-3">';
                        echo '<div id="add_service_button"><a data-reveal-id="myModal" href=""> + Record a new quote</a></div>';
                        echo '</div>';
                    } else if ($counter == 2) {
                        echo '<div class="quotes" id="tabs-1">';
                            include('php/quote_form_1.inc'); 
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-2">';
                            include('php/quote_form_2.inc'); 
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-3">';
                        echo '<div id="add_service_button"><a data-reveal-id="myModal" href=""> + Record a new quote</a></div>';
                        echo '</div>';
                    } else if ($counter == 3) {
                        echo '<div class="quotes" id="tabs-1">';
                            include('php/quote_form_1.inc'); 
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-2">';
                            include('php/quote_form_2.inc'); 
                        echo '</div>';
                        echo '<div class="quotes" id="tabs-3">';
                            include('php/quote_form_3.inc'); 
                        echo '</div>';
                    }
                ?>
            </div>
            <div id="title"><a href="status_vol.php">Back</a></div>
        </div>
    </section>
    <!--add new quote-->
    <div id="myModal" class="reveal-modal" class="quotes">
            <?php include('php/quotes_new.inc'); ?>
            <a class="close-reveal-modal">&#215;</a>        
    </div>
</body>
<?php include('php/footer.inc'); ?>
</html>