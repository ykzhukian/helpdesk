function validation() {
    var isCorrectPassword = checkPassword();
    // Check if they are all true -> return true
        // Else return false
    if (isCorrectPassword) {
        return true;
    } else {
        return false;
    }
}

function validation_user() {
    var isCorrectPassword = checkPassword_user();
    // Check if they are all true -> return true
        // Else return false
    if (isCorrectPassword) {
        return true;
    } else {
        return false;
    }
}

function checkPassword() {
    var password = document.forms["vol-register"]["password"].value;
    var retype = document.forms["vol-register"]["confirm_password"].value;
    if (password != retype) {
        document.getElementById("passwordError").style.visibility = "visible";
        document.getElementById("confirm_password").focus();
        return false;
    } else {
        hidePasswordError();
        return true;
    }

}

function checkPassword_user() {
    var password = document.forms["user-register"]["password"].value;
    var retype = document.forms["user-register"]["confirm_password"].value;
    if (password != retype) {
        document.getElementById("passwordError").style.visibility = "visible";
        document.getElementById("confirm_password").focus();
        return false;
    } else {
        hidePasswordError();
        return true;
    }

}

function hidePasswordError() {
    document.getElementById("passwordError").style.visibility = "hidden";
}

function display_detail_jobpool(index){
    if (document.getElementById("hide_" + index).style.display == "none") {

        document.getElementById("hide_" + index).style.display = null;
        document.getElementById("plus_" + index).src = "images/cross.png";

    } else {
        document.getElementById("hide_" + index).style.display = "none";
        document.getElementById("plus_" + index).src = "images/plus.png";

    }
}


function disableInput(index){
    document.getElementById("provider_disable" + index).disabled = true;
    document.getElementById("status_disable" + index).disabled = true;
    document.getElementById("install" + index).disabled = true;
    document.getElementById("preferred" + index).disabled = true;
    document.getElementById("running" + index).disabled = true;
    document.getElementById("per_disable" + index).disabled = true;
    document.getElementById("billed_disable" + index).disabled = true;
    document.getElementById("info" + index).disabled = true;
    document.getElementById("quote_update" + index).disabled = true;
    document.getElementById("quote_update" + index).style.display = "none";
    document.getElementById("quote_edit" + index).style.display = null;

}

function enableInput(index){
    document.getElementById("provider_disable" + index).disabled = false;
    document.getElementById("status_disable" + index).disabled = false;
    document.getElementById("install" + index).disabled = false;
    document.getElementById("preferred" + index).disabled = false;
    document.getElementById("running" + index).disabled = false;
    document.getElementById("per_disable" + index).disabled = false;
    document.getElementById("billed_disable" + index).disabled = false;
    document.getElementById("info" + index).disabled = false;
    document.getElementById("quote_update" + index).disabled = false;
    document.getElementById("quote_update" + index).style.display = null;
    document.getElementById("quote_edit" + index).style.display = "none";

}

function display_quote_detail(index){
    disableInput(index);    
    if (document.getElementById("quote_detail_" + index).style.display == "none") {
        
        document.getElementById("quote_detail_" + index).style.display = null;
        // document.getElementById("plus_" + index).src = "images/cross.png";

    } else {
        document.getElementById("quote_detail_" + index).style.display = "none";
        // document.getElementById("plus_" + index).src = "images/plus.png";

    }
}

function selectVol(index, id, count){
    
    clearVol(index, id, count);

    document.getElementById("vol_row_" + index + "_" + id).style.backgroundColor = "lightblue";

    document.getElementById("assign_result_email_" + id).value = document.getElementById("vol_assign_email_" + index).innerHTML;
}

//clear the block color
function clearVol(index, id, count){
    for(var i=1; i<=count; i++){
        document.getElementById("vol_row_" + i + "_" + id).style.backgroundColor = "#eee";
    }
}


function validation_assign(index){
    if (document.getElementById("assign_result_email_" +index).value == 0){
        document.getElementById("error_" +index).innerHTML = "You Haven't Selected Anyone";
        return false;
    } else {
        document.getElementById("error_" +index).innerHTML = "";
        return true;
    }
}




function vol_request_cancel_alert() {
    alert("You have canceled your request");
    window.location.assign("vol_request.php");
}

function request_cancel_alert() {
    alert("You have canceled your request");
    window.location.assign("request.php");
}




    