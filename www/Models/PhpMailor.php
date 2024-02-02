<?php

namespace App\Models;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
        //PROD :

        //$url = $_ENV['APP_URL'] . "/verify?token=" . $token;
        //$mail = new PHPMailer(true);
        //$mail->SMTPDebug = 0;
        //$mail->isSMTP();

        //Prod
        //$mail->Host       = 'smtp.gmail.com';
        //$mail->SMTPAuth   = true;
        //$mail->Username   = '';
        //$mail->Password   = '';
        //$mail->SMTPSecure = 'ssl';
        //$mail->Port       = 465;
        //$mail->CharSet = 'UTF-8';

        //$mail->setFrom("mehdicentime77@gmail.com", "mehdicentime77");
        //$mail->addAddress($mailtosend, $firstname . " " . $lastname);
        //$mail->isHTML(true);
        //$mail->Subject = "Bienvenue sur " . $firstname . " " . $lastname . " !";
        //$mail->Body    = "Pour vérifier votre compte, veuillez cliquer sur le lien suivant : " . "<br>" . "<br>" . "<a href='" . $url . "'>" . $url . "</a>";
        //try {
        //$mail->send();
        //} catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //}

        //DEV :
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
