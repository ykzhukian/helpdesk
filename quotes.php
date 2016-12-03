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
    <script src="javascript/ajax.js"></script>
    <script src="javascript/jquery-ui.js"></script>
</head>

<body>
    <?php 
        include('php/header_vol.inc'); 
        $job_result = $db->select('job_pool', 'job_id = "'.$_GET['keyword'].'"');
        foreach ($job_result as $key) { 
            $service_id = $key['service'];
        }

        $billed = $db->select_all('billed_period');
        $per = $db->select_all('rate');
        $provider = $db->select('service_provider', 'service_id = "'.$service_id.'"');

        $count_quotes = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'"');
        $number_quotes = 0;
        foreach ($count_quotes as $key) {
            $number_quotes++;
        }

        if ($number_quotes > 2) {
            // for quote 3
            $quote_3 = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'" AND preference = "3"');
            foreach ($quote_3 as $key) {
                $this_provider_3 = $key['provider_id'];
                $this_id_3 = $key['id'];
                $this_install_3 = $key['install_cost'];
                $this_running_3 = $key['running_cost'];
                $this_run_per_3 = $key['running_cost_per_id'];
                $this_billed_3 = $key['billed_id'];
                $this_status_3 = $key['status'];
                $this_info_3 = $key['info'];
                $date_3 = $key['date'];
                $accept_3 = $key['accept'];
            }

            foreach ($provider as $key) {
                if ($this_provider_3 == $key['id']) {
                    $this_provider_3 = $key['name'];
                }
            }    

            if ($this_status_3 == 1) {
                $this_status_3 = "Contact the provider";
            } else if ($this_status_3 == 2){
                $this_status_3 = "Awaiting Quote";  
            } else if ($this_status_3 == 3){
                $this_status_3 = "Quote Recorded";    
            }

            foreach ($per as $key) {
                if ($this_run_per_3 == $key['id']) {
                     $this_run_per_3 = $key['rate'];
                }
            }

        }

        if ($number_quotes > 1) {
            // for quote 2
            $quote_2 = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'" AND preference = "2"');
            foreach ($quote_2 as $key) {
                $this_provider_2 = $key['provider_id'];
                $this_id_2 = $key['id'];
                $this_install_2 = $key['install_cost'];
                $this_running_2 = $key['running_cost'];
                $this_run_per_2 = $key['running_cost_per_id'];
                $this_billed_2 = $key['billed_id'];
                $this_status_2 = $key['status'];
                $this_info_2 = $key['info'];
                $date_2 = $key['date'];
                $accept_2 = $key['accept'];
            }

            foreach ($provider as $key) {
                if ($this_provider_2 == $key['id']) {
                    $this_provider_2 = $key['name'];
                }
            }    

            if ($this_status_2 == 1) {
                $this_status_2 = "Contact the provider";
            } else if ($this_status_2 == 2){
                $this_status_2 = "Awaiting Quote";  
            } else if ($this_status_2 == 3){
                $this_status_2 = "Quote Recorded";    
            }

            foreach ($per as $key) {
                if ($this_run_per_2 == $key['id']) {
                     $this_run_per_2 = $key['rate'];
                }
            }
        }

        if ($number_quotes > 0) {
            // for quote 1
            $quote_1 = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'" AND preference = "1"');
            foreach ($quote_1 as $key) {
                $this_provider_1 = $key['provider_id'];
                $this_id_1 = $key['id'];
                $this_install_1 = $key['install_cost'];
                $this_running_1 = $key['running_cost'];
                $this_run_per_1 = $key['running_cost_per_id'];
                $this_billed_1 = $key['billed_id'];
                $this_status_1 = $key['status'];
                $this_info_1 = $key['info'];
                $date_1 = $key['date'];
                $accept_1 = $key['accept'];
            }

            foreach ($provider as $key) {
                if ($this_provider_1 == $key['id']) {
                    $this_provider_1 = $key['name'];
                }
            }    

            if ($this_status_1 == 1) {
                $this_status_1 = "Contact the provider";
            } else if ($this_status_1 == 2){
                $this_status_1 = "Awaiting Quote";  
            } else if ($this_status_1 == 3){
                $this_status_1 = "Quote Recorded";    
            }

            foreach ($per as $key) {
                if ($this_run_per_1 == $key['id']) {
                     $this_run_per_1 = $key['rate'];
                }
            }
        }

    ?>
    <section id="content">
            <div id="title">Current Job Quotes Summary</div>
            <div id="quote_list">
                <table id="quote_list_table">
                    <tr>
                        <td><div class="quote_list_title">Preferred</div></td>
                        <td><div class="quote_list_title">Company Name</div></td>
                        <td><div class="quote_list_title">Status</div></td>
                        <td><div class="quote_list_title">Setup Cost($)</div></td>
                        <td><div class="quote_list_title">Running Cost($)</div></td>
                        <td><div class="quote_list_title">Last Updated</div></td>
                    </tr>

                    <?php
                        $quotes = $db->select('quotes', 'job_id = "'.$_GET['keyword'].'"');
                        $counter = 0;
                        foreach ($quotes as $key) {
                            $counter++;
                        }
                        if ($counter == 0) {
                            echo '<tr><td colspan="6"><div id="add_service_button"><a data-reveal-id="myModal" href=""> + New quote</a></div></td></tr>';
                            echo '<tr><td colspan="6"><div id="add_service_button"><a data-reveal-id="myModal" href=""> + New quote</a></div></td></tr>';
                            echo '<tr><td colspan="6"><div id="add_service_button"><a data-reveal-id="myModal" href=""> + New quote</a></div></td></tr>';
                        } else if ($counter == 1){
                            //first quote
                            if ($accept_1 == 3){
                                echo '<tr class="declined">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_1.'</td>
                                <td>'.$this_status_1.'</td>
                                <td>'.$this_install_1.'</td>
                                <td>'.$this_running_1.' per '.$this_run_per_1.'</td>
                                <td>'.$date_1.'</td>
                                </tr>';
                            } else {
                                echo '<tr class="quote_form_center" onClick="display_quote_detail(1);">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_1.'</td>
                                <td>'.$this_status_1.'</td>
                                <td>'.$this_install_1.'</td>
                                <td>'.$this_running_1.' per '.$this_run_per_1.'</td>
                                <td>'.$date_1.'</td>
                            </tr>';
                            echo '<tr id="quote_detail_1" class="quote_form_row" style="display:none;">
                                <td></td>
                                <td colspan = "6">';
                                    include('php/quote_form_1.inc');
                            echo '
                                </td>

                            </tr>';
                            }
                            
                            //empty row
                            echo '<tr class=""><td colspan="6"><div id="add_service_button"><a data-reveal-id="myModal" href=""> + New quote</a></div></td></tr>';
                            echo '<tr class=""><td colspan="6"><div id="add_service_button"><a data-reveal-id="myModal" href=""> + New quote</a></div></td></tr>';
                        } else if ($counter == 2){
                            //first quote
                            if ($accept_1 == 3){
                                echo '<tr class="declined">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_1.'</td>
                                <td>'.$this_status_1.'</td>
                                <td>'.$this_install_1.'</td>
                                <td>'.$this_running_1.' per '.$this_run_per_1.'</td>
                                <td>'.$date_1.'</td>
                                </tr>';
                            } else {
                                echo '<tr class="quote_form_center" onClick="display_quote_detail(1);">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_1.'</td>
                                <td>'.$this_status_1.'</td>
                                <td>'.$this_install_1.'</td>
                                <td>'.$this_running_1.' per '.$this_run_per_1.'</td>
                                <td>'.$date_1.'</td>
                            </tr>';
                            echo '<tr id="quote_detail_1" class="quote_form_row" style="display:none;">
                                <td></td>
                                <td colspan = "6">';
                                    include('php/quote_form_1.inc');
                            echo '
                                </td>

                            </tr>';
                            }

                            //second quote
                            if ($accept_2 == 3){
                                echo '<tr class="declined">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_2.'</td>
                                <td>'.$this_status_2.'</td>
                                <td>'.$this_install_2.'</td>
                                <td>'.$this_running_2.' per '.$this_run_per_2.'</td>
                                <td>'.$date_2.'</td>
                                </tr>';
                            } else {
                                echo '<tr class="quote_form_center" onClick="display_quote_detail(2);">
                                    <td></td>
                                    <td>'.$this_provider_2.'</td>
                                    <td>'.$this_status_2.'</td>
                                    <td>'.$this_install_2.'</td>
                                    <td>'.$this_running_2.' per '.$this_run_per_2.'</td>
                                    <td>'.$date_2.'</td>
                                </tr>';
                                echo '<tr id="quote_detail_2" class="quote_form_row" style="display:none;">
                                    <td></td>
                                    <td colspan = "6">';
                                        include('php/quote_form_2.inc');
                                echo '
                                    </td>

                                </tr>';
                            }
                            // empty row
                            echo '<tr class=""><td colspan="6"><div id="add_service_button"><a data-reveal-id="myModal" href=""> + New quote</a></div></td></tr>';

                        } else if ($counter == 3){
                            //first quote
                            if ($accept_1 == 3){
                                echo '<tr class="declined">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_1.'</td>
                                <td>'.$this_status_1.'</td>
                                <td>'.$this_install_1.'</td>
                                <td>'.$this_running_1.' per '.$this_run_per_1.'</td>
                                <td>'.$date_1.'</td>
                                </tr>';
                            } else {
                                echo '<tr class="quote_form_center" onClick="display_quote_detail(1);">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_1.'</td>
                                <td>'.$this_status_1.'</td>
                                <td>'.$this_install_1.'</td>
                                <td>'.$this_running_1.' per '.$this_run_per_1.'</td>
                                <td>'.$date_1.'</td>
                            </tr>';
                            echo '<tr id="quote_detail_1" class="quote_form_row" style="display:none;">
                                <td></td>
                                <td colspan = "6">';
                                    include('php/quote_form_1.inc');
                            echo '
                                </td>

                            </tr>';
                            }

                            //second quote
                            if ($accept_2 == 3){
                                echo '<tr class="declined">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_2.'</td>
                                <td>'.$this_status_2.'</td>
                                <td>'.$this_install_2.'</td>
                                <td>'.$this_running_2.' per '.$this_run_per_2.'</td>
                                <td>'.$date_2.'</td>
                                </tr>';
                            } else {
                                echo '<tr class="quote_form_center" onClick="display_quote_detail(2);">
                                    <td></td>
                                    <td>'.$this_provider_2.'</td>
                                    <td>'.$this_status_2.'</td>
                                    <td>'.$this_install_2.'</td>
                                    <td>'.$this_running_2.' per '.$this_run_per_2.'</td>
                                    <td>'.$date_2.'</td>
                                </tr>';
                                echo '<tr id="quote_detail_2" class="quote_form_row" style="display:none;">
                                    <td></td>
                                    <td colspan = "6">';
                                        include('php/quote_form_2.inc');
                                echo '
                                    </td>

                                </tr>';
                            }

                            // third quote
                            if ($accept_3 == 3){
                                echo '<tr class="declined">
                                <td><img id="intro" src="images/done.png" alt="intro" width="30" /></td>
                                <td>'.$this_provider_3.'</td>
                                <td>'.$this_status_3.'</td>
                                <td>'.$this_install_3.'</td>
                                <td>'.$this_running_3.' per '.$this_run_per_3.'</td>
                                <td>'.$date_3.'</td>
                                </tr>';
                            } else {
                                echo '<tr class="quote_form_center" onClick="display_quote_detail(3);">
                                    <td></td>
                                    <td>'.$this_provider_3.'</td>
                                    <td>'.$this_status_3.'</td>
                                    <td>'.$this_install_3.'</td>
                                    <td>'.$this_running_3.' per '.$this_run_per_3.'</td>
                                    <td>'.$date_3.'</td>
                                </tr>';
                                echo '<tr id="quote_detail_3" class="quote_form_row" style="display:none;">
                                    <td></td>
                                    <td colspan = "6">';
                                        include('php/quote_form_3.inc');
                                echo '
                                    </td>

                                </tr>';
                            }
                        }
                    ?>

                </table>
            </div>


            <div id="title"><a href="status_vol.php">Back</a></div>
    </section>


    
    
    <!--add new quote-->
    <div id="myModal" class="reveal-modal" class="quotes">
            <?php include('php/quotes_new.inc'); ?>
            <a class="close-reveal-modal">&#215;</a>        
    </div>

    
</body>
<?php include('php/footer.inc'); ?>
</html>