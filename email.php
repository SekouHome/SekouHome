<?php

require_once('PHPMailer/PHPMailerAutoload.php');

function sendEmail($code, $email)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure ='ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();

    $mail->Username = 'sekoujabateh@live.com';
    $mail->Password = 'Mayama1988';

    $mail->setFrom('no-reply@sms.com', 'no-reply@sms.co.uk');
    $mail->Subject = 'Your One Time Login Code!';
    $mail->Body = 'Please enter the follwoing code in to the box and click verify to login! <br>    ' . $code;
    //$mail->AddAddress('jabateh80@hotmail.com');
    $mail->addAddress($email);

    if(!$mail->send()) 
    {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else 
    {
//        echo 'Message has been sent';
    }
}

?>