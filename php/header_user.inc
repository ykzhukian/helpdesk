<header>
        <div id="google_translate_element"></div><script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <div id="header">
            <div id="header-logo"><img src="images/logo.png" alt="Logo" width="200" /></div>
            <?php
                if($_SESSION['user'] == "in"){
                        echo "
                            <div id='sign_out'><a href='signout.php'>Sign Out</a></div>
                            ";
                    }
            ?>
            <div class="header"><a href="request.php">New Request</a></div>
            <div class="header"><a href="status_user.php">My Requests</a></div>
            <?php
                if($_SESSION['user'] == "in"){
                        echo"
                            <div class='header'>Hi, ".$_SESSION['firstname']."</div>
                            ";
                    }
            ?>
        </div>
    </header>