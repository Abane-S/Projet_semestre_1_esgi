<?php

namespace App\Controllers;

use App\Controllers\Error;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserDelete;
use App\Forms\UserLogin;
use App\Forms\PwdForget;
use App\Forms\PwdChange;
use App\Forms\ModifieAccount;
use App\Core\Verificator;
use App\Models\PhpMailor;
use App\Models\User;

class Security
{
    public static function UserIsLogged(): bool {
        return isset($_SESSION['Account']) && !empty($_SESSION['Account']);
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

                $phpMailer = new PhpMailor(SMTP_USERNAME, SMTP_EMAIL, SMTP_PASSWORD, SMTP_HOST);
                $subject = "Verify your account";
                $message = "
                    <h1>Thanks For Registration</h1>
                    <p>Click on the link below to verify your account</p>
                    <a href='http://".$_SERVER['HTTP_HOST']."/verify?email=".$user->getEmail()."&token=".$token."'>Verify</a>
                ";
                $phpMailer->sendMail($user->getEmail(), $subject, $message);
                echo '<style>#modal1 { display: flex; }</style>';
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

                        $subject = "Change your password";
                        $message = "
                            <p>Click on the link below to change your password</p>
                            <a href='http://".$_SERVER['HTTP_HOST']."/change-password?email=".$account->getEmail()."&code=".$token."'>Change your password</a>
                        ";
                        $mailer->sendMail($user->getEmail(), $subject, $message);
                        echo '<style>#modal2 { display: flex; }</style>';

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


    public function DeleteAccount(): void
    {
        if (!$this->UserIsLogged()){
            $view = new View("Error/page404", "front");
            exit;
        }
        $form = new UserDelete();
        $view = new View("Security/deleteaccount", "front");
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValidDelete())
        {
            $user = new User();
            $account = $user->getOneBy(["email" => strtolower($_SESSION['Account']['email'])], "object");
            if($_POST["account_delete"] == "soft")
            {
                $account->setIsdeleted(1);
                $account->save();
                session_destroy();
                echo '<style>#modal5 { display: flex; }</style>';
            }
            else
            {
                if($account->HardDeleteAccount($_SESSION['Account']['email']))
                {
                    session_destroy();
                    echo '<style>#modal5 { display: flex; }</style>';
                }
                else
                {
                    $errors['user_email'] = "-Une erreur s'est produite lors de la suppression de votre compte.";
                    $view->assign('errors', $errors);
                }

            }
        }
        else{
            $view->assign('errors', $form->listOfErrors);
        }
    }

    public function modifieAccount(): void
    {
        if ($this->UserIsLogged() == true) {

            $form = new ModifieAccount();
            $view = new View("Security/accountmodification", "front");
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidAccountModification()) {
                $user = new User();
                $account = $user->getOneBy(["email" => strtolower($_SESSION['Account']['email'])], "object");
                if(!empty($_POST["user_firstname"]))
                {
                    $account->setFirstname($_POST["user_firstname"]);
                }
                if(!empty($_POST["user_lastname"]))
                {
                    $account->setLastname($_POST["user_lastname"]);
                }
                if(!empty($_POST["user_password"]))
                {
                    $account->setPassword($_POST["user_password"]);
                }
                if(empty($_POST["user_password"]) && empty($_POST["user_lastname"]) && empty($_POST["user_password"]) && empty($_POST["user_confirm_password"]))
                {
                    header("Location: " . '/');
                    exit;
                }
                $account->save();
                session_destroy();
                echo '<style>#modal3 { display: flex; }</style>';

            } else {
                $view->assign('errors', $form->listOfErrors);
            }
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