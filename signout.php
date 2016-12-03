<?php
    session_start();
    // change the user status to out, unable the review post function
    $_SESSION['user'] = "out";
    $_SESSION['username'] = "Please login";
    // go to home page after loging out
    header('Location: index.php');
?>