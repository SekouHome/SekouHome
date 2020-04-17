<?php

$username = $_SESSION['username'];

// Check if form was submitted
if(isset($_POST['verify']))
{ 
    $input = $_POST['otp']; // Get input
    
    if ($stmt = $GLOBALS['database'] -> prepare("SELECT `otp` FROM `users` WHERE `username` = ?"))
    {
        echo $_SESSION['username'];
        $stmt -> bind_param("s", $username);
        $stmt -> execute();
        $stmt -> bind_result($otp);
        $stmt -> store_result();
        
        while ($stmt -> fetch())
        {
//            echo $input . " = " . $otp . "<br>";

            if ($input = $otp)
            {
                $code = NULL;
                if ($new = $GLOBALS['database'] -> prepare("UPDATE `users` SET `otp` = ? WHERE `username` = ?"))
                {
                    $new -> bind_param("ss", $code, $username);
                    $new -> execute();

                    $new -> close();
                }
                header("Location: " . $GLOBALS['home'] . "/home.php");
            }
        }
        $stmt -> close();
    }
}

?>