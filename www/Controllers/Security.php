<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;

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


}