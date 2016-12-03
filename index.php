<html class="login-page">
<head lang="en">
    <meta charset="UTF-8">
    <title>Migration</title>
    <!--link to css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <!--link to js-->
    <script src="javascript/myjs.js"></script>
</head>
<body>
    <!--include header-->
    <?php include('php/header_main.inc'); ?>
    <div id="main-body">
         <img id="intro" src="images/homepage.png" alt="intro" width="700" />
    </div>

    <!--include header-->
    <section id="content-login">
        <?php 
                $errors = array(); //record login errors
                $volunteer = 0; // check if the user is a volunteer or a client
                $firstname = ""; // initial firstname
                if (isset($_POST['username']))
                {
                    // link to validation of server part
                    require 'php/login_validation.inc';
                    validateUser($errors, $_POST, $volunteer, $firstname);
                    if ($errors){
                        // link to registration form
                        include 'php/login_form.inc';
                    }
                    else
                    {   
                        session_start();
                        $_SESSION['user'] = "in"; // record login status of the user
                        $_SESSION['firstname'] = $firstname; // record the firstname of user to show Hi, name
                        $_SESSION['username'] = $_POST['username'];
                        if ($volunteer == 0) {
                            header('Location: status_user.php');// header to user interface
                        } else {
                            header('Location: status_vol.php'); // header to volunteer interface
                        }
                    }
                } else{
                    // link to the registration form
                    include 'php/login_form.inc';
                }
            ?>
    </section>

</body>
</html>