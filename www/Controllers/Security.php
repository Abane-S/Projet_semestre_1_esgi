<?php

namespace App\Controllers;

use App\Controllers\Error;
use App\Models\Tokens;

use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;
use App\Forms\PwdForget;
use App\Forms\ModifieAccount;
use App\Core\Verificator;
use App\Models\PhpMailor;
use App\Models\User;

class Security
{

    public function login(): void
    {
        if (isset($_SESSION['user']['id'])) {
            header("Location: " . '/');
        }
        $form = new UserLogin();
        $view = new View("Security/login", "front");
        $view->assign('config', $form->getConfig());
        if ($form->isSubmit() && $form->isValid()){
            echo "bonjour";
            if (empty($errors)){
                $user = new User();
                $user->setEmail($_POST['user_email']);
                $user->setPassword($_POST['user_password']);
                if ($user->login()){
                    $userInfos = $user->login();
                    $token = new Tokens();
                    $token->setUserId($userInfos['id']);
                    $token->createToken();
                    if ($userInfos['email_verified']){
                        $this->setSession($userInfos, $token->getToken());
                        header("Location: " . '/');
                    } else {
                        $view->assign('errors', ['user_email' => "Votre compte n'est pas encore vérifié. Veuillez vérifier votre boite mail"]);
                    }
                } else {
                    $view->assign('errors', ['user_email' => "Email ou mot de passe incorrect"]);
                }
            }else{
                $view->assign('errors', $errors);
            }
        }
    }


    public function logout(): void
    {
        echo "Ma page de déconnexion";
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
        if (isset($_SESSION['Connected']))
        {
            header("Location: " . '/');
        }

        $form = new UserInsert();
        $view = new View("Security/register", "front");
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValid()){
            $user = new User();
            if ($user->emailExist($_POST['user_email'])){
                $errors['user_email'] = "L'adresse e-mail est déjà utilisée. Merci de bien vouloir renseigner une autre adresse e-mail.";
                $view->assign('errors', $errors);
            }else{
                $token = bin2hex(random_bytes(32));
                $user->setVericationToken($token);
                $user->setFirstname($_POST['user_firstname']);
                $user->setLastname($_POST['user_lastname']);
                $user->setEmail($_POST['user_email']);
                $user->setPassword($_POST['user_password']);
                $user->save();


                $phpMailer = new PhpMailor();
                $phpMailer->setMail($_POST['user_email']);
                $phpMailer->setFirstname($_POST['user_firstname']);
                $phpMailer->setLastname($_POST['user_lastname']);
                $phpMailer->setToken($token);
                $phpMailer->sendMail();
                header("Location: " . '/email-verification');
            }
        }else{
            $view->assign('errors', $form->listOfErrors);
        }

    }



    public function pwdForget(): void
    {
        if (isset($_SESSION['Connected']))
        {
            header("Location: " . '/');
        }

        $form = new PwdForget();
        $view = new View("Security/forgetPwd", "front");
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit()){
            $user = new User();
        }else{
            $view->assign('errors', $form->listOfErrors);
        }
    }

    public function modifieAccount(): void
    {
        $form = new ModifieAccount();
        $config = $form->getConfig();
        $errors = [];
        $myView = new View("Security/accountInfo", "front");
        $myView->assign("configForm", $config);
        $myView->assign("errorsForm", $errors);
        echo "Ma page de modification cu compte";
    }

    public function confirmedEmail(): void
    {
        $user = new User();
        $userverified = $user->getOneBy(["email_verified" => 1], "object");
        //Si le compte est ps connected et vefifier son email_verified à 1
        if ($userverified == true || (isset($_SESSION['Connected']) && $_SESSION['Connected'] != true)) {
            $myView = new View("Security/emailconfirmed", "front");
        }
        else
        {
            die("Page 404");
            $customError = new Error();
            $customError->page404();
        }
    }

    public function verifyEmailNotify(): void
    {
        $user = new User();
        $userverified = $user->getOneBy(["email_verified" => 0], "object");
        //Si le compte est ps connected et vefifier son email_verified à 1
        if ($userverified == true || (isset($_SESSION['Connected']) && $_SESSION['Connected'] != true)) {
            $myView = new View("Security/emailconfirmedmsg", "front");
        }
        else
        {
            die("Page 404");
            $customError = new Error();
            $customError->page404();
        }
    }

    public function verifyEmail()
    {
        if (!isset($_GET['token']) || empty($_GET['token'])) {
            die("Page 404");
            $customError = new Error();
            $customError->page404();
        } else {
            $token = $_GET['token'];
            $user = new User();
            $userverified = $user->getOneBy(["verification_token" => $token], "object");
            if ($userverified == false) {
                die("Page 404");
                $customError = new Error();
                $customError->page404();
            } else {

                $userverified->setEmailVerified(1);
                $userverified->save();
                header("Location: " . '/email-confirmed');
            }
        }

    }
}