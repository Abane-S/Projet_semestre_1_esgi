<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;
use App\Forms\PwdForget;
use App\Forms\ModifieAccount;

class Security
{

    public function login(): void
    {
        $form = new UserLogin();
        $config = $form->getConfig();
        $errors = [];


        $myView = new View("Security/login", "front");
        $myView->assign("configForm", $config);
        $myView->assign("errorsForm", $errors);
    }
    public function logout(): void
    {
        echo "Ma page de déconnexion";
    }

    public function register(): void
    {
        $form = new UserInsert();
        $config = $form->getConfig();
        $errors = [];


        //Est ce que le formulaire a été soumis
        if (!empty($_POST)){

            //Ensuite est-ce que les données sont OK
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    $errors[] = "Erreur " . $key . " ne peut être vide.";

                }
            }

            //-> si oui insertion en bdd
            if(empty($errors))
            {
                //$myUser = new User();
                //$myUser->setFirstname("post nom");
                //$myUser->setLastname("post prenom   ");
                //$myUser->setEmail("post email");
                //$myUser->setPwd("post mdp");
                //$myUser->save();
            }

            
        }



        //-> sinon on va envoyer les erreurs à la vue

        $myView = new View("Security/register", "front");
        $myView->assign("configForm", $config);
        $myView->assign("errorsForm", $errors);

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