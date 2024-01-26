<?php

namespace App\Controllers;

use App\Controllers\Error;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;
use App\Forms\PwdForget;
use App\Forms\PwdChange;
use App\Forms\ModifieAccount;
use App\Core\Verificator;
use App\Models\PhpMailor;
use App\Models\User;

class Security
{
    public function UserIsLogged(): bool {
        return isset($_SESSION['Connected']) && $_SESSION['Connected'] == true;
    }


    public function login(): void
    {
        if ($this->UserIsLogged()){
            header("Location: /needtologout");
            exit;
        }

        $form = new UserLogin();
        $view = new View("Security/login", "front");
        $view->assign('config', $form->getConfig());
        if ($form->isSubmit() && $form->isValid()){
            $user = new User();
            $account = $user->getOneBy(["email" => strtolower($_POST['user_email'])], "object");
            if ($account)
            {
                if (password_verify($_POST['user_password'], $account->getPassword())) {
                    if($account->getEmailVerified())
                    {
                        if(!$account->getIsDeleted())
                        {
                            $accountArray = $user->getOneBy(["email" => strtolower($_POST['user_email'])], "array");
                            $_SESSION['Connected'] = true;
                            $_SESSION['Account'] = $accountArray;
                            if($account->getRole() == "user")
                            {
                                header("Location: /");
                                exit;
                            }
                            if($account->getRole() == "moderator")
                            {
                                header("Location: /moderator");
                                exit;
                            }
                            if($account->getRole() == "admin")
                            {
                                header("Location: /dashboard");
                                exit;
                            }
                        }
                        else
                        {
                            $errors['user_email'] = "-L'adresse e-mail que vous avez saisie n'est associée à aucun compte.";
                            $view->assign('errors', $errors);
                            exit;
                        }
                    }
                    else
                    {
                        $errors['user_email'] = "-Un mail d'activation vous a été envoyé lors de la création de votre compte.<br>Merci de confirmer votre adresse e-mail.";
                        $view->assign('errors', $errors);
                        exit;
                    }
                }
                else
                {
                    $errors['user_email'] = "-Le mot de passe est incorrecte.";
                    $view->assign('errors', $errors);
                    exit;
                }
            }
            else
            {
                $errors['user_email'] = "-L'adresse e-mail que vous avez saisie n'est associée à aucun compte.";
                $view->assign('errors', $errors);
                exit;
            }
        }
        else{
            $view->assign('errors', $form->listOfErrors);
        }
    }


    public function logout(): void
    {
        session_destroy();
        $view = new View("Security/logout", "front");
    }

    /**
     * This code handles the login functionality and user registration.
     * If the user is already logged in, it redirects to the dashboard.
     * It creates a new UserInsert form and assigns it to the view.
     * If the form is submitted, it validates the form data and performs user registration if there are no errors.
     * If the email already exists, it displays an error message.
     * After successful registration, it generates a verification token, saves the user data, and redirects to the login page.
     * If there are any errors in the form data, it assigns the errors to the view.
     */

    public function register(): void
    {
        if ($this->UserIsLogged()){
            header("Location: /needtologout");
            exit;
        }

        $form = new UserInsert();
        $view = new View("Security/register", "front");
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValid()){
            $user = new User();
            $account = $user->getOneBy(["email" => $_POST['user_email']], "object");
            if ($account)
            {
                $errors['user_email'] = "-L'adresse e-mail est déjà utilisée. Merci de bien vouloir renseigner une autre adresse e-mail.";
                $view->assign('errors', $errors);
                exit;
            }else{
                $token = bin2hex(random_bytes(32));
                $user->setVericationToken($token);
                $user->setFirstname($_POST['user_firstname']);
                $user->setLastname($_POST['user_lastname']);
                $user->setEmail($_POST['user_email']);
                $user->setPassword($_POST['user_password']);
                $user->setRole("user");
                $user->save();

                $phpMailer = new PhpMailor();
                $phpMailer->sendMail($_POST['user_email'], $_POST['user_firstname'], $_POST['user_lastname'], $token, "Verification");
                header("Location: " . '/email-verification');
                exit;
            }
        }else{
            $view->assign('errors', $form->listOfErrors);
        }

    }



    public function pwdForget(): void
    {
        if ($this->UserIsLogged()){
            header("Location: /");
            exit;
        }

        $form = new PwdForget();
        $view = new View("Security/forgetpwd", "front");
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValid()){
            $user = new User();
            $account = $user->getOneBy(["email" => strtolower($_POST['user_email'])], "object");
            if ($account)
            {
                if($account->getEmailVerified())
                {
                    if(!$account->getIsDeleted()) {
                        $token = bin2hex(random_bytes(32));
                        $account->setVericationToken($token);
                        $account->save();

                        $phpMailer = new PhpMailor();
                        $phpMailer->sendMail($_POST['user_email'], $_POST['user_firstname'], $_POST['user_lastname'], $token, "VerificationPassword");
                        header("Location: " . '/password-verification-notify');
                        exit;
                    }
                    else
                    {
                        $errors['user_email'] = "-L'adresse e-mail que vous avez saisie n'est associée à aucun compte.";
                        $view->assign('errors', $errors);
                        exit;
                    }
                }
                else
                {
                    $errors['user_email'] = "-Un mail d'activation vous a été envoyé lors de la création de votre compte.<br>Merci de confirmer votre adresse e-mail.";
                    $view->assign('errors', $errors);
                    exit;
                }
            }
            else
            {
                $errors['user_email'] = "-L'adresse e-mail que vous avez saisie n'est associée à aucun compte.";
                $view->assign('errors', $errors);
                exit;
            }
        }else{
            $view->assign('errors', $form->listOfErrors);
        }
    }


    public function softDeleteAccount(): void
    {

    }

    public function hardDeleteAccount(): void
    {

    }

    public function modifieAccount(): void
    {
        if ($this->UserIsLogged() == true) {

            $form = new ModifieAccount();
            $view = new View("Security/accountmodification", "front");
            $view->assign('config', $form->getConfig());
        }
        else
        {
            $view = new View("Error/page404", "front");
        }
    }

    public function confirmedEmail(): void
    {
        if ($this->UserIsLogged() == false) {
            $view = new View("Security/emailconfirmed", "front");
        }
        else
        {
            $view = new View("Error/page404", "front");
        }
    }

    public function ChangePasswordNotify():void
    {
        if ($this->UserIsLogged() == false) {
            $view = new View("Security/passwordverificationmsg", "front");
        }
        else
        {
            $view = new View("Error/page404", "front");
        }
    }

    public function ChangePasswordVerification():void
    {
        if (!isset($_GET['token']) || empty($_GET['token'])) {
            $view = new View("Error/page404", "front");
        } else {
            $token = $_GET['token'];
            $user = new User();
            $account = $user->getOneBy(["verification_token" => $token], "object");
            if (!$account) {
                die("Page 404");
                $customError = new Error();
                $customError->page404();
            } else {
                $form = new PwdChange();
                $view = new View("Security/changepassword", "front");
                $view->assign('config', $form->getConfig());
                if($account->getEmailVerified())
                {
                    if(!$account->getIsDeleted())
                    {
                        if ($form->isSubmit() && $form->isValid()) {
                            $token = bin2hex(random_bytes(32));
                            $account->setPassword($_POST['user_password']);
                            $account->setVericationToken($token);
                            $account->save();
                            header("Location: " . '/password-changed');
                        } else {
                            $view->assign('errors', $form->listOfErrors);
                        }
                    }
                    else
                    {
                        $errors['user_email'] = "-L'adresse e-mail que vous avez saisie n'est associée à aucun compte.";
                        $view->assign('errors', $errors);
                        exit;
                    }
                }
                else
                {
                    $errors['user_email'] = "-Un mail d'activation vous a été envoyé lors de la création de votre compte.<br>Merci de confirmer votre adresse e-mail.";
                    $view->assign('errors', $errors);
                    exit;
                }

            }
        }
    }

    public function passwordChangedSucces(): void
    {
        if ($this->UserIsLogged() == false){
            $view = new View("Security/passwordconfirmedmsg", "front");
        }
        else
        {
            $view = new View("Error/page404", "front");
        }
    }

    public function verifyEmailNotify(): void
    {
        if ($this->UserIsLogged() == false) {
            $view = new View("Security/emailconfirmedmsg", "front");
        }
        else
        {
            $view = new View("Error/page404", "front");
        }
    }

    public function needToLogout()
    {
        //Si le compte est ps connected et vefifier son email_verified à 1
        if ($this->UserIsLogged() == true) {
            $view = new View("Security/needtologout", "front");
        }
        else
        {
            $view = new View("Error/page404", "front");
        }
    }

    public function verifyEmail()
    {
        if (!isset($_GET['token']) || empty($_GET['token'])) {
            $view = new View("Error/page404", "front");
        } else {
            $token = $_GET['token'];
            $user = new User();
            $account = $user->getOneBy(["verification_token" => $token], "object");
            if (!$account) {
                die("Page 404");
                $customError = new Error();
                $customError->page404();
            } else {
                $token = bin2hex(random_bytes(32));
                $account->setEmailVerified(1);
                $account->setVericationToken($token);
                $account->save();
                header("Location: " . '/email-confirmed');
                exit;
            }
        }

    }
}