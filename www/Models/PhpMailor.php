<?php

namespace App\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

class PhpMailor
{

    public function sendMail($mailtosend, $firstname, $lastname, $token, $type): void
    {
        if($type == "Verification") {
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
            $url = "http://localhost:8081/verify?token=" . $token;
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mailhog-server';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->Port = 1025;

            $mail->setFrom("notreadresseemailsite@gmail.com", "Admin");
            $mail->addAddress($mailtosend, $firstname . " " . $lastname);
            $mail->isHTML(true);
            $mail->Subject = "Bienvenue sur " . $firstname . " " . $lastname . " !";
            $mail->Body = "Merci d'activer votre compte en cliquant sur le lien d'activation : " . "<br>" . "<a href='" . $url . "'>" . $url . "</a>";
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent.\nMailer Error: {$mail->ErrorInfo}";
            }
        }
        if($type == "VerificationPassword") {
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
            $url = "http://localhost:8081/verify2?token=" . $token;
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mailhog-server';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->Port = 1025;

            $mail->setFrom("notreadresseemailsite@gmail.com", "Admin");
            $mail->addAddress($mailtosend, $firstname . " " . $lastname);
            $mail->isHTML(true);
            $mail->Subject = "Demande de changement de mot de passe " . $firstname . " " . $lastname . " !";
            $mail->Body = "Pour changer votre mot de passe, merci de confirmer qu'il s'agit bien de vous en cliquant sur le lien de confirmation : " . "<br>" . "<a href='" . $url . "'>" . $url . "</a>";
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent.\nMailer Error: {$mail->ErrorInfo}";
            }
        }

    }
}
