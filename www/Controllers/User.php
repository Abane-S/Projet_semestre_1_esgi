<?php

namespace App\Controllers;


use App\Core\View;
use App\Models\Users;
use App\Forms\createAndEditUser as createAndEdit;

class User
{

    public function showAllUsers(): void
    {
        $view = new View("Dashboard/users/showAllUsers", "back");
        $users = new Users();
        $view->assign("users", $users->findAll());
        if (isset($_GET[0])) {
            $userId = $_GET[0];
            $user = new Users();
            $account = $user->getOneBy(["id" => $userId], "object");
            if ($account) {
                $modal = [
                    "title" => "Suppression d'utilisateur",
                    "content" => "Êtes-vous sûr(e) de vouloir supprimer cette utilsateur ?",
                    "button-message" => "Supprimer l'utilisateur",
                    "button-color" => "danger",
                    "redirect" => "/dashboard/users",
                ];
                // $user->delete($userId);
                $view->assign("modal", $modal);
            }
            else {
                $modal = [
                    "title" => "Utilisateur introuvable !",
                    "content" => "L'utilisateur que vous souhaitez supprimer n'existe pas.",
                    "redirect" => "/dashboard/users"
                ];
                $view->assign("modal", $modal);
            }
        }
    }

    public function createUser(): void
    {
        $view = new View("Dashboard/Users/createAndEditUser", "back");
        $form = new createAndEdit();
        $view->assign("form", $form->getConfig());
        $view->assign("title", "Créer un utilisateur");


        if ($form->isSubmit() && $form->isValid()){
            $user = new Users();
            $account = $user->getOneBy(["email" => $_POST['user_email']], "object");
            if ($account)
            {
                $errors['user_email'] = "L'adresse e-mail est déjà utilisée. Merci de bien vouloir renseigner une autre adresse e-mail.";
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
                    "content" => "L'utilisateur a été enregistré avec succès. N'oubliez pas de vérifier son adresse e-mail pour qu'il puisse accéder à son compte.",
                    "redirect" => "/dashboard/users"
                ];
                $view->assign("modal", $modal);
            }
        }else{
            $view->assign('errors', $form->listOfErrors);
        }
        
    }

    public function editUser(): void
    {
        if (isset($_GET[0])){
            $userId = $_GET[0];
            $user = new Users();
            $account = $user->getOneBy(["id" => $userId], "table");
            if ($account)
            {  
                $view = new View("Dashboard/Users/createAndEditUser", "back");
                $form = new createAndEdit($account);
                $view->assign("form", $form->getConfig());
                $view->assign("title", "Modifier un utilisateur");

                if ($form->isSubmit() && $form->isValid()){
                    $token = bin2hex(random_bytes(32));
                    $user->setVericationToken($token);
                    $user->setId($userId);
                    $user->setFirstname($_POST['user_firstname']);
                    $user->setLastname($_POST['user_lastname']);
                    $user->setEmail($_POST['user_email']);
                    $user->setPassword($_POST['user_password']);
                    $user->setRole($_POST['role']);
                    $user->save();
                    
                    $modal = [
                        "title" => "Données modifiées avec succès !",
                        "content" => "Les données de l'utilisateur ont été modifiées. Si vous ne l'avez pas déjà fait n'oubliez pas de vérifier son adresse e-mail pour qu'il puisse accéder à son compte.",
                        "redirect" => "/dashboard/users"
                    ];
                    $view->assign("modal", $modal);
                }
            }else{
                $view->assign('errors', $form->listOfErrors);
            }
        }else{
            $modal = [
                "title" => "Utilisateur introuvable !",
                "content" => "L'utilisateur que vous souhaitez modifier n'existe pas.",
                "redirect" => "/dashboard/users"
            ];
            $view = new View("Dashboard/users/showAllUsers", "back");
            $view->assign("users", $user->findAll());
            $view->assign("modal", $modal);
        }   
        
    }

    public function deleteUser(): void
    {
        if (isset($_GET[0])) {
            $userId = $_GET[0];
            $user = new Users();
            $account = $user->getOneBy(["id" => $userId], "object");
            if ($account) {
                $modal = [
                    "title" => "Suppression d'utilisateur",
                    "content" => "Êtes-vous sûr(e) de vouloir supprimer cette utilsateur ?",
                    "button-message" => "Supprimer",
                    "button-color" => "danger",
                    "redirect" => "/dashboard/users/confirmDeleteUser/$userId",
                    "second-button-redirect" => "/dashboard/users",
                    "second-button" => "Annuler",
                ];
                // $user->delete($userId);
                $view = new View("Dashboard/users/showAllUsers", "back");
                $view->assign("users", $user->findAll());
                $view->assign("modal", $modal);
            }
            else {
                $modal = [
                    "title" => "Utilisateur introuvable !",
                    "content" => "L'utilisateur que vous souhaitez supprimer n'existe pas.",
                    "redirect" => "/dashboard/users"
                ];
                $view = new View("Dashboard/users/showAllUsers", "back");
                $view->assign("users", $user->findAll());
                $view->assign("modal", $modal);
            }
        }
    }


    public function confirmDeleteUser() {
        $userId = $_GET[0] ?? null;
        $user = new Users();
        $account = $user->getOneBy(["id" => $userId], "object");
        if ($userId && $account) {
            $user->setId($userId);
            $user->delete();
            header("Location: /dashboard/users");
            exit;
        }
        else {
            $modal = [
                "title" => "Utilisateur introuvable !",
                "content" => "L'utilisateur que vous souhaitez supprimer n'existe pas.",
                "redirect" => "/dashboard/users"
            ];
            $view = new View("Dashboard/users/showAllUsers", "back");
            $view->assign("users", $user->findAll());
            $view->assign("modal", $modal);
        }
    }
    
}