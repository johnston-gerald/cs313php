<div id="page" class='center'>
    <div id="main">
        <form method="post" id="login_form">
            <fieldset>
                <h3>Please sign in</h3>
                <label for="username">Username:</label>
                <input id="username" name="username" type="text" />
                <br>

                <label for="password">Password:</label>
                <input id="password" name="password" type="password" />
                <br><br>

                <label for="login">&nbsp;</label>
                <input id="login" name="login" value="Sign In" type="submit"/>
<!--                &nbsp;or&nbsp;
                <input id="register" name="register" value="Register" type="submit"/>-->
                
                <p><?php echo $login_message; ?></p>
            </fieldset>
        </form>
    </div><!-- end main -->
</div><!-- end page -->