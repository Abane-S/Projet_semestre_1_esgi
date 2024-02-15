<?php

namespace App\Controllers;

use App\Core\View;
use App\FileStorage\Upload;
use App\Forms\CreatePage;
use App\Forms\CreateUser;
use App\Forms\EditPage;
use App\Forms\EditUser;
use App\Models\Pages as PagesModel;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Comment;
use App\Forms\CommentUpdate;

class Admin
{
    public function pages(): void
    {
        $view = new View("Admin/pages", "back");
        $pages = new Pages();
        $view->assign("pages", $pages->getAllPages());
    }

    public function commentsUpdate(): void
    {
        if($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur") {
            $commentID = basename(strtolower($_SERVER["REQUEST_URI"]));
            $form = new CommentUpdate();
            $view = new View("Admin/Comments/commentsUpdate", "back");
            $view->assign('config', $form->getConfig());

            $comments = new Comment();
            $commentArray = $comments->getOneBy(["id" => $commentID], "array");
            $_SESSION['Comment'] = $commentArray;

            if ($form->isSubmit() && $form->isValidCommentUpdate())
            {
                $commentsToUpdate = $comments->getOneBy(["id" => $commentID], "object");
                if($commentsToUpdate)
                {
                    $commentsToUpdate->setValid($_POST["comment_valid"]);
                    $commentsToUpdate->setCommenttitle($_POST["comment_title"]);
                    $commentsToUpdate->setComment($_POST["comment"]);
                    $commentsToUpdate->save();
                    $view = new View("Admin/Comments/commentsDelete", "back");
                    $modal = [
                        "title" => "Comments modifier avec succes",
                        "content" => "Le commentaire a bien été modifier.",
                        "redirect" => "/dashboard/comments"
                    ];
                    $view->assign("modal", $modal);
                }
                else
                {
                    $view = new View("Admin/Comments/commentsDelete", "back");
                    $modal = [
                        "title" => "Erreur lors de la modification du commentaire",
                        "content" => "Impossible de modifier ce commentaire",
                        "redirect" => "/dashboard/comments"
                    ];
                    $view->assign("modal", $modal);
                }
            }
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function commentsDelete(): void
    {
        if($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur") {
            $commentID = basename(strtolower($_SERVER["REQUEST_URI"]));
            $comments = new Comment();
            if ($comments->deleteComment($commentID) == 1) {
                $view = new View("Admin/Comments/commentsDelete", "back");
                $modal = [
                    "title" => "Comments supprimer avec succes",
                    "content" => "Le commentaire a bien été supprimé.",
                    "redirect" => "/dashboard/comments"
                ];
                $view->assign("modal", $modal);
            } else {
                $view = new View("Admin/Comments/commentsDelete", "back");
                $modal = [
                    "title" => "Erreur lors de la suppression du commentaire",
                    "content" => "Impossible de supprimer ce commentaire",
                    "redirect" => "/dashboard/comments"
                ];
                $view->assign("modal", $modal);
            }
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function comments(): void
    {
        $view = new View("Admin/Comments/commentsShowAdmin", "back");
        $comments = new Comment();
        $view->assign("comments", $comments->getAllComments());
    }

    public function menus(): void
    {
        //$view = new View("Admin/Menus/menus", "back");
        //$menus = new MenuModel();
        //$view->assign("pages", $pages->getAllMenu());
    }


    public function pagesShowAdmin(): void
    {
        $view = new View("Admin/Pages/showAdminPages", "back");
        $pages = new PagesModel();
        $view->assign("pages", $pages->getAllPages());
    }

    public function createPages(): void
    {
        $view = new View("Admin/Pages/createPages", "back");
        $form = new CreatePage();
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValidPages())
        {
            if ($form->isValidImages($_FILES['page_file']['tmp_name'], $_FILES['page_file']['name']) ) {
                $page = new PagesModel();
                $page->setTitle($_POST['page_title']);
                $page->setMeta_description($_POST['page_meta_description']);
                $page->setMiniature($_FILES['page_file']['name']);
                $page->setComments($_POST['page_comment']);
                $page->setContent($_POST['page_content']);
                $upload = new Upload();
                $upload->uploadFile($_FILES['page_file']);
                $page->save();
                $modal = [
                    "title" => "Page creé avec succes",
                    "content" => "La Page a bien été creé.",
                    "redirect" => "/dashboard/pages"
                ];
                $view->assign("modal", $modal);
            }
            else
            {
                $view->assign('errors', $form->listOfErrors);
            }
        }
        else
        {
            $view->assign('errors', $form->listOfErrors);
        }
    }

    public function deletePages (): void
    {
        $view = new View("Admin/Pages/deletePages", "back");
        $pageID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $page = new Pages();
            if ($page->deletePage($pageID) == 1) {
                $modal = [
                    "title" => "Page supprimer avec succes",
                    "content" => "Le page a bien été supprimé.",
                    "redirect" => "/dashboard/pages"
                ];
                $view->assign("modal", $modal);
            } else {
                $modal = [
                    "title" => "Erreur lors de la suppression de la page",
                    "content" => "Impossible de supprimer la page",
                    "redirect" => "/dashboard/pages"
                ];
                $view->assign("modal", $modal);
            }
    }

    public function editPages(): void
    {
        $pageID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $view = new View("Admin/Pages/updatePages", "back");
        $form = new EditPage();
        $view->assign('config', $form->getConfig());

        $page = new PagesModel();
        $pageArray = $page->getOneBy(["id" => $pageID], "array");
        $_SESSION['Page'] = $pageArray;

        if ($form->isSubmit() && $form->isValidPages())
        {
            if ($form->isValidImages($_FILES['page_file']['tmp_name'], $_FILES['page_file']['name']) ) {

                $pageToUpdate = $page->getOneBy(["id" => $pageID], "object");
                if($pageToUpdate)
                {
                    $pageToUpdate->setTitle($_POST['page_title']);
                    $pageToUpdate->setMeta_description($_POST['page_meta_description']);
                    $pageToUpdate->setMiniature($_FILES['page_file']['name']);
                    $pageToUpdate->setComments($_POST['page_comment']);
                    $pageToUpdate->setContent($_POST['page_content']);
                    $upload = new Upload();
                    $upload->uploadFile($_FILES['page_file']);
                    $pageToUpdate->save();
                $modal = [
                    "title" => "Page modifié avec succes",
                    "content" => "La Page a bien été modifié.",
                    "redirect" => "/dashboard/pages"
                ];
                $view->assign("modal", $modal);
                }
                else
                {
                    $modal = [
                        "title" => "Erreur lors de la modification de la page",
                        "content" => "Impossible de modifier la page",
                        "redirect" => "/dashboard/pages"
                    ];
                    $view->assign("modal", $modal);
                }
            }
            else
            {
                $view->assign('errors', $form->listOfErrors);
            }
        }
        else
        {
            $view->assign('errors', $form->listOfErrors);
        }

    }

    public function createMenus(): void
    {
        $view = new View("Admin/Pages/create", "back");

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $menu = new MenuModel();
            $menu->setTitle($_POST["title"]);
            $menu->setUrl($_POST["url"]);
            $menu->setParentId($_POST["parent_id"]);
            $menu->setOrder($_POST["order"]);
            $menu->setIsVisible($_POST["is_visible"]);
            $menu->setIsDeleted($_POST["is_deleted"]);
            $menu->create();
            header("Location: /admin/pages");
        }
    }

    public function users(): void
    {
        $view = new View("Admin/users/usersShow", "back");
        $users = new User();
        $view->assign("users", $users->findAll());
    }

    public function userUpdate(): void
    {
        $userID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $view = new View("Admin/Users/userUpdate", "back");
        $form = new EditUser();
        $view->assign('config', $form->getConfig());

        $user = new User();
        $userArray = $user->getOneBy(["id" => $userID], "array");
        $_SESSION['User'] = $userArray;

        if ($form->isSubmit() && $form->isValidUserCreation())
        {
                $userToUpdate = $user->getOneBy(["id" => $userID], "object");
                if($userToUpdate)
                {
                    $userToUpdateaccount = $userToUpdate->getOneBy(["email" => $_POST['user_email']], "object");
                    if ($userToUpdateaccount)
                    {
                        $errors['user_email'] = "-L'adresse e-mail est déjà utilisée. Merci de bien vouloir renseigner une autre adresse e-mail.";
                        $view->assign('errors', $errors);
                        exit;
                    }
                    else{
                        $token = bin2hex(random_bytes(32));
                        $userToUpdate->setVericationToken($token);
                        $userToUpdate->setFirstname($_POST['user_firstname']);
                        $userToUpdate->setLastname($_POST['user_lastname']);
                        $userToUpdate->setEmail($_POST['user_email']);
                        $userToUpdate->setPassword($_POST['user_password']);
                        $userToUpdate->setEmailVerified(1);
                        $userToUpdate->setRole($_POST['role']);
                        $userToUpdate->save();

                        $modal = [
                            "title" => "Utilisateur modifier avec succès !",
                            "content" => "L'utilisateur a été modifer avec succès.",
                            "redirect" => "/dashboard/users"
                        ];
                        $view->assign("modal", $modal);

                    }
                }
                else
                {
                    $modal = [
                        "title" => "Erreur lors de la modification de l'utilisateur",
                        "content" => "Impossible de modifier l'utilisateur",
                        "redirect" => "/dashboard/users"
                    ];
                    $view->assign("modal", $modal);
                }
        }
        else
        {
            $view->assign('errors', $form->listOfErrors);
        }

    }

    public function userDelete(): void
    {
        $view = new View("Admin/Users/userDelete", "back");
        $userID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $user = new User();
        if ($user->deleteUser($userID) == 1) {
            $modal = [
                "title" => "Utilisateur supprimer avec succes",
                "content" => "L'utilisateur a bien été supprimé.",
                "redirect" => "/dashboard/users"
            ];
            $view->assign("modal", $modal);
        } else {
            $modal = [
                "title" => "Erreur lors de la suppression de l'utilisateur",
                "content" => "Impossible de supprimer l'utilisateur",
                "redirect" => "/dashboard/users"
            ];
            $view->assign("modal", $modal);
        }
    }

    public function createUsers(): void
    {
        $view = new View("Admin/Users/CreateUser", "back");
        $form = new CreateUser();
        $view->assign("form", $form->getConfig());

        if ($form->isSubmit() && $form->isValidUserCreation()){
            $user = new User();
            $account = $user->getOneBy(["email" => $_POST['user_email']], "object");
            if ($account)
            {
                $errors['user_email'] = "-L'adresse e-mail est déjà utilisée. Merci de bien vouloir renseigner une autre adresse e-mail.";
                $view->assign('errors', $errors);
                exit;
            }
            else{
                $token = bin2hex(random_bytes(32));
                $user->setVericationToken($token);
                $user->setFirstname($_POST['user_firstname']);
                $user->setLastname($_POST['user_lastname']);
                $user->setEmail($_POST['user_email']);
                $user->setPassword($_POST['user_password']);
                $user->setEmailVerified(1);
                $user->setRole($_POST['role']);
                $user->save();

                $modal = [
                    "title" => "Utilisateur crée avec succès !",
                    "content" => "L'utilisateur a été crée avec succès.",
                    "redirect" => "/dashboard/users"
                ];
                $view->assign("modal", $modal);

            }
        }else{
            $view->assign('errors', $form->listOfErrors);
        }

    }
}