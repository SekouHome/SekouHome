<?php

getHeader("Social Media Site");

//function addOTP($code)
//{
//    if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `users` (`otp`) VALUES (?)"))
//    {
//        $stmt -> bind_param("s", $code);
//        $stmt -> execute();
//        $last_id = $stmt -> insert_id; // The ID of the row just inserted
//
//        $stmt -> close();
////        header("Location: " . $GLOBALS['home'] . "/users/account.php");
//    }
//}

?>
<!--

<script>
    function genOTP()
    {
        var otp = Math.floor((Math.random() * 99999999) + 0);
        
        alert(otp);
        
        addOTP();
    }

</script>
-->


<div class="container-fluid">
    <div class="row">

        <div class="col"></div>

        <div class="col-4">
            <form method=POST>

                <h4>Create an account</h4>
              
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password must be 8-20 characters long, contain letters and numbers.
                    </small>
                </div>

                <div class="form-group">
                    <label for="repeat-password">Repeat Password:</label>
                    <input type="password" class="form-control" placeholder="Repeat password" name="repeat-password" required>
                    <small id="repeatPasswordHelpBlock" class="form-text text-muted">
                        Your passwords must match.
                    </small>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="customControlInline" required>
                        <label class="custom-control-label" for="customControlInline">Agree to terms and conditions.</label>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-outline-primary" formaction="/users/register.php">Sign Up</button>
                </div>
            </form>
        </div>

        <div class="col-1"></div>

        <div class="col-4">
            <form method=POST>

                <h4>Login</h4>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                </div>
                
<!--
                <div class="form-group">
                    <label for="otp">Verification code</label>
                    <input type="text" class="form-control" placeholder="Click the button below to recive an email with a one time code"
                           name="otp" id="otp" min="1" max="99999999" required>
                </div>
-->
                
<!--
                <div class="form-group text-center">
                    <button class="btn btn-outline-success" onclick="genOTP()" type="button">Send</button>
                </div> 
                
-->
                <button class="btn btn-outline-primary" formaction="../users/login.php">Login</button>
            </form>
        </div>

        <div class="col"></div>

    </div>

    <div class="row">
        <div class="col-6">
            <p></p>
        </div>
    </div>

</div>

<?php

getFooter();

?>
