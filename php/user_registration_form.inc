<div id="registerAs">Register as a Client</div>
            <form id="user-register" onsubmit="return validation_user();" method="POST" action="register_user.php">
                <label for="username">Username(e-mail): </label><br />
                <input type="email" name="username" id="username" required value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username'])?>"/>
                <span id="emailUsed"> <?php if (isset($errors['username'])) echo $errors['username'] ?> </span><br />
                <label for="password">Password: </label>
                <label for="confirm_password" class="confirm_password">Confirm Password: </label><br />
                <input type="password" name="password" id="password"required onkeypress="hidePasswordError()"/>
                <input type="password" name="confirm_password" id="confirm_password"required onkeypress="hidePasswordError()"/>
                <span id="passwordError">Different</span><br />
                <label for="firstname">First Name: </label>
                <label for="lastname" class="lastname">Last Name: </label><br />
                <input type="text" name="firstname" id="firstname"required value="<?php if(isset($_POST['firstname']))
        echo htmlspecialchars($_POST['firstname'])?>"/>
                <input type="text" name="lastname" id="lastname"required value="<?php if(isset($_POST['lastname']))
        echo htmlspecialchars($_POST['lastname'])?>"/><br />
                <label for="language">Language: </label>
                <input type="text" name="language" id="language"required value="<?php if(isset($_POST['language']))
        echo htmlspecialchars($_POST['language'])?>"/><br />
                <label for="region">Region: </label>
                <input type="text" name="region" id="region"required value="<?php if(isset($_POST['region']))
        echo htmlspecialchars($_POST['region'])?>"/><br />
                <label for="contact_number">Contact Number: </label>
                <input type="contact_number" name="contact_number" id="contact_number" required value="<?php if(isset($_POST['contact_number']))
        echo htmlspecialchars($_POST['contact_number'])?>"/>
                <br />
                <input type="submit" value="Submit" id="submit_vol">
            </form>