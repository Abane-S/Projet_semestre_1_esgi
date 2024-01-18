<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;
use App\Forms\PwdForget;
use App\Forms\ModifieAccount;
use App\Core\Verificator;
use App\Models\User;

class Security
{

    public function login(): void
    {
        // $form = new UserLogin();
        // $config = $form->getConfig();
        // $errors = [];


        // $myView = new View("Security/login", "front");
        // $myView->assign("configForm", $config);
        // $myView->assign("errorsForm", $errors);


        
    }
    public function logout(): void
    {
        echo "Ma page de déconnexion";
    }

    public function register(): void
    {
        /**
         * This code handles the login functionality and user registration.
         * If the user is already logged in, it redirects to the dashboard.
         * It creates a new UserInsert form and assigns it to the view.
         * If the form is submitted, it validates the form data and performs user registration if there are no errors.
         * If the email already exists, it displays an error message.
         * After successful registration, it generates a verification token, saves the user data, and redirects to the login page.
         * If there are any errors in the form data, it assigns the errors to the view.
         */
        
        // if (isset($_SESSION['user']))
        // {
        //     Utils::redirect("dashboard");
        // }
        $form = new UserInsert();
        $view = new View("Security/register", "front");
        $view->assign('config', $form->getConfig());
        // if (isset($_SESSION['user']['id'])) {
        //     $this>redirect('/');
        // }
        if ($form->isSubmit()){
            $errors = verificator::formRegister($form->getConfig(), $_POST);
            if (empty($errors)){
                $user = new User();
                if ($user->emailExist($_POST['user_email'])){
                    $errors['user_email'] = "Cette adresse email est déjà utilisée";
                    $view->assign('errors', $errors);
                }else{
                    $token = bin2hex(random_bytes(32));
                    $user->setVericationToken($token);
                    $user->setFirstname($_POST['user_firstname']);
                    $user->setLastname($_POST['user_lastname']);
                    $user->setEmail($_POST['user_email']);
                    $user->setPassword($_POST['user_password']);
                    $user->save();
                    parrent::redirect('/login');
                    echo "Votre compte a bien été créé";
                }
            }else{
                $view->assign('errors', $errors);
            }
        }

    }

    public function pwdForget(): void
    {
        $form = new PwdForget();
        $config = $form->getConfig();
        $errors = [];
        $myView = new View("Security/forgetPwd", "front");
        $myView->assign("configForm", $config);
        $myView->assign("errorsForm", $errors);
        echo "Ma page de mot de passe oublié";
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

}