function add_service() {
    var input = document.getElementById("new_service_name").value;
    if (input == "") {
        document.getElementById("error_message").innerHTML = "Please enter something";
        return 0;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            

            document.getElementById("result-ajax").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "../site/php/insert_new_service_vol.php?q=" + input, true);
    xmlhttp.send();
}


function add_language(){
    var input = document.getElementById("new_language_name").value;
    if (input == "") {
        document.getElementById("error_message_language").innerHTML = "Please enter something";
        return 0;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            

            document.getElementById("language-ajax").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "../site/php/insert_new_language_vol.php?q=" + input, true);
    xmlhttp.send();
}

function sendEmail(index){
    var address = document.getElementById("email_address_" + index).value;
    var content = document.getElementById("info_" + index).value;
    if (content == "") {
        document.getElementById("error_message_email_" + index).innerHTML = "Please write something";
        return 0;
    }

    console.log(content);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            

            document.getElementById("result-ajax-" + index).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "../site/php/send_email.php?q=" + address + "&p=" + content, true);
    xmlhttp.send();
}


function searchResult(index){
    var name = document.getElementById("search"+index).value;
    var search_language_select = document.getElementById("search_language"+index);
    var search_region_select = document.getElementById("search_region"+index);
    console.log();


    var search_language = search_language_select.options[search_language_select.selectedIndex].value;
    var search_region = search_region_select.options[search_region_select.selectedIndex].value;

    console.log(name);
    console.log(search_language);
    console.log(search_region);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("search-ajax"+index).innerHTML = xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", "php/search_result.php?name=" + name + "&search_language=" + search_language + "&search_region=" + search_region + "&job_id=" + index, true);
    xmlhttp.send();
}

function send_quote_email(index){
    var address = document.getElementById("quote_email_" + index).value;
    var content = document.getElementById("quote_info_" + index).value;
    var title = document.getElementById("quote_title_" + index).value;
    var jobid = document.getElementById("job_id_" + index).value;
    var quote_id = document.getElementById("quote_id_" + index).value;
    if (content == "") {
        document.getElementById("error_message_send_quote" + index).innerHTML = "Please write something";
        return 0;
    }

    console.log(content);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            

            document.getElementById("ajax-quote-email-" + index).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "../site/php/send_quote.php?q=" + address + "&p=" + content + "&title=" + title + "&id=" + jobid + "&quote=" + quote_id, true);
    xmlhttp.send();
}

function accept_quote(index, quote){
    var address = document.getElementById("email_vol_" + index).innerHTML;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ajax-quote-accept-" + index).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "../site/php/accept_quote.php?q=" + address + "&id=" + index + "&quote=" + quote, true);
    xmlhttp.send();
}

function decline_quote(index, quote){
    var address = document.getElementById("email_vol_" + index).innerHTML;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ajax-quote-accept-" + index).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "../site/php/decline_quote.php?q=" + address + "&id=" + index + "&quote=" + quote, true);
    xmlhttp.send();
}





