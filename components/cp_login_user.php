<section id="login" class="pb-0">
    <div class="container pb-0 pt-5">
        <h2 class="text-center"></h2>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <?php
                if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "An error occurred in the registration";
                            $class="alert-warning";
                            break;
                        case 1:
                            $message = "Successful registration";
                            $class="alert-success";
                            break;
                        case 2:
                            $message = "There was an error logging in";
                            $class="alert-warning";
                            break;
                        case 3:
                            $message = "Login successfully";
                            header("Location: ./profile.php");
                            $class="alert-success";
                            break;
                        case 4:
                            $message = "User is deactivated";
                            $class="alert-warning";
                            break;
                        case 5:
                            $message = "To vote this article please sign-in!";
                            $class="alert-warning";
                            break; 
                        case 6:
                            $message = "After profile changes you have to re sign-in!";
                            $class="alert-warning";
                            break;
                        default:
                            $msg_show = false;
                    }

                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
                    " . $message . "
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                    </div>";
                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                }
                ?>
            </div>
            <div class="col-lg-6 col-12 pb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <form id="login-form" class="py-2" role="form" action="scripts_public/sc_user_login.php" method="post">
                            <div class="form-group">
                                <label for="inputEmailForm" class="sr-only form-control-label">Username</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="text" class="form-control" id="inputEmailForm" name="username"
                                           placeholder="username"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordForm" class="sr-only form-control-label">Password</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="password" class="form-control" id="inputPasswordForm" name="password"
                                           placeholder="password" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10">
                                    <div class="checkbox form-control form-control-sm text-center small">
                                        <label class="">
                                            <input type="checkbox" class=""> remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Sign-in
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10">
                                    <div class="text-center">
                                        <a href="components_public/cp_user_password_recover.php" tabindex="5"
                                           class="forgot-password">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 pb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Sign-up</h2>
                        <form method="post" role="form" id="register-form" action="scripts_public/sc_user_register.php">
                            <div class="form-group">
                                <label for="input2EmailForm" class="sr-only form-control-label">username</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="text" class="form-control" id="input2UserForm" name="username"
                                           placeholder="username"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input2EmailForm" class="sr-only form-control-label">email</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="email" class="form-control" id="input2EmailForm" name="email"
                                           placeholder="email"
                                           required="required" onchange="email_validate(this.value);">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input2PasswordForm" class="sr-only form-control-label">password</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="password" required="required"
                                           onkeyup="checkPass(); return false;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input2Password2Form" class="sr-only form-control-label">verify</label>
                                <div class="mx-auto col-sm-10">
                                    <input type="password" class="form-control" id="password_confirm"
                                           placeholder="verify password" required="required"
                                           onkeyup="checkPass(); return false;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block">Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>

<script>

    function checkPass() {
        //Store the password field objects into variables ...
        var pass1 = $("#register-form #password");
        var pass2 = $("#register-form #password_confirm");

        console.log(pass1.value, pass2);
        //Store the Confimation Message Object ...
        var message = $('#confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field
        //and the confirmation field
        if (pass1.val() == pass2.val()) {
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            pass2.css("backgroundColor", goodColor);
            message.css("color", goodColor);
            message.html("Passwords Match");
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.css("backgroundColor", badColor);
            message.css("color", badColor);
            message.html("Passwords Do Not Match!");
        }
    }

    function validatephone(phone) {
        var maintainplus = '';
        var numval = phone.value
        if (numval.charAt(0) == '+') {
            var maintainplus = '';
        }
        curphonevar = numval.replace(/[\\A-Za-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g, '');
        phone.value = maintainplus + curphonevar;
        var maintainplus = '';
        phone.focus;
    }

    // validates text only
    function Validate(txt) {
        txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
    }

    // validate email
    function email_validate(email) {
        var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

        if (regMail.test(email) == false) {
            document.getElementById("status").innerHTML = "<span class='warning'>Email address is not valid yet.</span>";
        } else {
            document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>";
        }
    }
    </script>