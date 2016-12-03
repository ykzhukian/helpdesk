<div id="login_form">
            <img id="logo" src="images/logo.png" alt="logo" width="200" />
            <form id="home-login" action="index.php" method="POST" onsubmit="return validation();">
                <input type="text" name="username" class="login" placeholder=" Username(E-mail)" required value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username'])?>"/><br />
                <input type="password" name="password" class="login" placeholder=" Password" required />
                <a href="register_vol.php"><input type="button" class="login" name="register" id="register" value="Register" /></a>
                <input type="submit" value="Login" id="submit" class="login"/>
            </form>
            <div id="powered">Powered by Developer Migration</div>
            <div id="login_error"><?php if (isset($errors['username'])) echo $errors['username'] ?></div>
        </div>