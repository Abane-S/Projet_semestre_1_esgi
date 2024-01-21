<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

class PhpMailor
{
    private $mail;
    private $firstname;
    private $lastname;
    private $token;

    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname): void
    {
        $this->lastname  = $lastname;
    }

    public function setToken($token): void
    {
        $this->token = $token;
    }

    public function sendMail(): void
    {
        //PROD :

        //$url = $_ENV['APP_URL'] . "/verify?token=" . $this->token;
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
        //$mail->addAddress($this->mail, $this->firstname . " " . $this->lastname);
        //$mail->isHTML(true);
        //$mail->Subject = "Bienvenue sur " . $this->firstname . " " . $this->lastname . " !";
        //$mail->Body    = "Pour vérifier votre compte, veuillez cliquer sur le lien suivant : " . "<br>" . "<br>" . "<a href='" . $url . "'>" . $url . "</a>";
        //try {
            //$mail->send();
        //} catch (Exception $e) {
           // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //}

        //DEV :
        $url = "http://localhost:8081/verify?token=" . $this->token;
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'mailhog-server';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->Port       = 1025;

        $mail->setFrom("notreadresseemailsite@gmail.com", "Admin");
        $mail->addAddress($this->mail, $this->firstname . " " . $this->lastname);
        $mail->isHTML(true);
        $mail->Subject = "Bienvenue sur " . $this->firstname . " " . $this->lastname . " !";
        $mail->Body    = "Merci d'activer votre compte en cliquant sur le lien d'activation : " . "<br>" . "<a href='" . $url . "'>" . $url . "</a>";
        try {
        $mail->send();
        }
        catch (Exception $e)
        {
         echo "Message could not be sent.\nMailer Error: {$mail->ErrorInfo}";
        }
    }
}
