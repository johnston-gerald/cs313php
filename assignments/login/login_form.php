<br>
<form method="post" id="login_form">
    <fieldset>
        <h3>Please sign in</h3>
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input id="username" name="username" type="text" /></td>
            </tr>

            <tr>
                <td><label for="password">Password:</label></td>
                <td><input id="password" name="password" type="password" /></td>
            </tr>

            <tr>
                <td><label for="login">&nbsp;</label></td>
                <td><input id="login" name="login" value="Sign In" type="submit"/>&nbsp;or&nbsp;
                    <input id="signup" name="signup" value="Sign Up" type="submit"/></td>
            </tr>
        </table>
        <p><?php if(isset($login_message)){echo $login_message;} ?></p>
    </fieldset>
</form>