<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

class PhpMailor
{

    public function sendMail($receiver, $subject = "Subject", $body = "Body"): void
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_EMAIL, SMTP_NAME);
        $mail->addAddress($receiver);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;
        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent.\nMailer Error: {$mail->ErrorInfo}";
        }    
    }
}
