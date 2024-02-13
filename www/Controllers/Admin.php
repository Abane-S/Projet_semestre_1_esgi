<?php

namespace App\Controllers;

use App\Core\View;
use App\FileStorage\Upload;
use App\Forms\CreatePage;
use App\Forms\CreateUser;
use App\Forms\UserInsert;
use App\Models\Pages as PagesModel;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Comment;
use App\Forms\CommentUpdate;
use App\Models\PhpMailor;

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
            if ($form->isSubmit() && $form->isValidCommentUpdate())
            {
                $comments = new Comment();
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
        $view = new View("Admin/Menus/menus", "back");
        $menus = new MenuModel();
        $view->assign("pages", $pages->getAllMenu());
    }


    public function pagesShowAdmin(): void
    {
        $view = new View("Admin/Pages/pages", "back");
        $pages = new PagesModel();
        $view->assign("pages", $pages->getAllPages());
    }

    public function createPages(): void
    {
        $view = new View("Admin/Pages/create", "back");
        $form = new CreatePage();
        $view->assign('config', $form->getConfig());

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['title'] != "") {
            $page = new PagesModel();
            $page->setTitle($_POST['title']);
            $page->setMeta_description($_POST['meta_description']);
            $page->setMiniature($_FILES['files']['name']??"");
            $page->setComments(isset($_POST['comments']) ? 1 : 0);
            $page->setContent($_POST['content']);

            $upload = new Upload();
            $upload->uploadFile($_FILES['files']);
            $page->save();

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
        $view = new View("Admin/users/Users", "back");
        $users = new User();
        $view->assign("users", $users->findAll());
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