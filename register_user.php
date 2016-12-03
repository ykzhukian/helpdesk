<html class="vol-register-page">
<head lang="en">
    <meta charset="UTF-8">
    <title>Migration</title>
    <!--link to css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <!--link to js-->
    <script src="javascript/myjs.js"></script>
</head>
<body>
    <header>
        <!--google translate tool-->
        <div id="google_translate_element"></div><script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <div id="header">
            <div id="header-logo"><img src="images/logo.png" alt="Logo" width="200" /></div>
            <div id="already">Already has an account: <a href="index.php">Login</a><br />Or <a href="register_vol.php">Sign up as a Volunteer?</a></div>
            <!-- <div class="header"><img src="images/face_black.png" alt="Logo" width="45" /></div> -->
        </div>
    </header>
    <section id="content">
        <div id="vol_pic">
            <img src="images/plane.png" alt="Logo" width="300" />
        </div>
        <div id="registration">
            <?php 
                $errors = array();
                if (isset($_POST['username']))
                {
                    // link to validation of server part
                    require 'php/register_validation.inc';
                    validateEmail($errors, $_POST, 'username');
                    if ($errors){
                        // link to registration form
                        include 'php/user_registration_form.inc';
                    }
                    else
                    {
                        // if no errors, insert the new user to database
                        include 'php/insert_user_to_db.inc';
                        echo "<div class='successfully_signup'> You have successfully signed up!</div>";
                        echo "<div class='successfully_signup'><a href='index.php'> Log in</a></div>";
                    }

                } else{
                    // link to the registration form
                    include 'php/user_registration_form.inc';
                }
            ?>
        </div>
    </section>
</body>
<?php include('php/footer.inc'); ?>
</html>