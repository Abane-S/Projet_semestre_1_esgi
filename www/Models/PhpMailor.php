<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

class PhpMailor
{

    private $senderName;
    private $senderEmail;
    private $password;
    private $SMTPhost;

    public function __construct($senderName,$senderEmail,$password,$SMTPhost)
    {
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->password = $password;
        $this->SMTPhost = $SMTPhost;
    }

    public function sendMail($receiver, $subject = "Test subject", $body = "Test body"): void
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'mailhog-server';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->Port = SMTP_PORT;

        $mail->setFrom($this->senderEmail, $this->senderName);
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
