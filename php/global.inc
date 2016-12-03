<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = "";
    }
    if (!isset($_SESSION['firstname'])) {
        $_SESSION['firstname'] = "Please login";
    }
    if (!isset($_SESSION['username'])) {
        $_SESSION['username'] = "Please login";
    }
    if ($_SESSION['user'] != "in"){
    	header("location: index.php");
    }
?>
