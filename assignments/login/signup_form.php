<script>
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #signup_form element
    $("#signup_form").validate({
    
        // Specify the validation rules
        rules: {
            username: "required",
//            email: {
//                required: true,
//                email: true
//            },
            password1: {
                required: true,
                minlength: 7
            },
            password2: {
                required: true,
                minlength: 7,
                equalTo: "#password1"
            },
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            username: " * Please enter a username",
            password1: {
                required: " * Please provide a password",
                minlength: " * Your password must be at least 7 characters long"
            },
            password2: {
                required: " * Please provide a password",
                minlength: " * Your password must be at least 7 characters long",
                equalTo: " * Please enter the same password as above"
            },
//            email: "Please enter a valid email address",
            agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>

<br>
<form method="post" id="signup_form" novalidate="novalidate">
    <fieldset>
        <h3>Please register</h3>
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input id="username" name="username" type="text" /></td>
            </tr>

            <tr>
                <td><label for="password1">Password:</label></td>
                <td><input id="password1" name="password1" type="password" /></td>
            </tr>
        
            <tr>
                <td><label for="password2">Enter password again:</label></td>
                <td><input id="password2" name="password2" type="password" /></td>
            </tr>

            <tr>
                <td></td>
                <td><input id="submit_reg" name="submit_reg" type="submit" value="Register"/></td>
            </tr>
        </table>
        <p><?php if(isset($login_message)){echo "<label class='error'>$login_message</label>";} ?></p>
    </fieldset>
</form>