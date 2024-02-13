<?php

namespace App\Controllers;


use App\Core\View;
use App\Models\Users;
use App\Forms\CreateUser;

class User
{

    public function showAllUsers(): void
    {
        $view = new View("Dashboard/users/showAllUsers", "back");
        $users = new User();
        $view->assign("users", $users->findAll());
    }

    public function create(): void
    {
        $view = new View("Admin/Users/CreateUser", "back");
        $form = new CreateUser();
        $view->assign("form", $form->getConfig());


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
                $user->setRole($_POST['role']);
                $user->save();
                
                $modal = [
                    "title" => "Utilisateur enregistré avec succès !",
                    "content" => "Félicitations ! L'utilisateur a été enregistré avec succès. Vous pouvez maintenant accéder à son profil et gérer ses informations.",
                    "redirect" => "/dashboard/users"
                ];
                $view->assign("modal", $modal);

            }
        }else{
            $view->assign('errors', $form->listOfErrors);
        }
        
    }
}