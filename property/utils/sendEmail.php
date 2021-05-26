<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$root = __DIR__;
require $root.'/PHPMailer/src/Exception.php';
require $root.'/PHPMailer/src/PHPMailer.php';
require $root.'/PHPMailer/src/SMTP.php';

function sendEmail($to, $name = "", $subject, $body){
    $mail = new PHPMailer(true);
    try{
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "91rezao@gmail.com";
        $mail->Password   = "jao12345678";
        //Recipients
        $mail->setFrom('91rezao@gmail.com', 'APP localhost');

        $mail->addAddress($to, $name);     //Add a recipient
    
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body  = $body;
        $mail->send();
    
        return true;
    }catch(\Exception $e){
        return false;
    }
}