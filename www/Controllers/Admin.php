<?php

namespace App\Controllers;

use App\Core\View;
use App\FileStorage\Upload;
use App\Forms\CreatePage;
use App\Forms\CreateMenu;
use App\Forms\CreateUser;
use App\Forms\EditPage;
use App\Forms\EditUser;
use App\Forms\EditMenu;
use App\Models\Pages as PagesModel;
use App\Models\Menus as MenuModel;
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
        $view = new View("Admin/Menus/showMenusAdmin", "back");
        $menus = new MenuModel();
        $view->assign("menus", $menus->getAllMenu());
    }

    public function menusCreate(): void
    {
        $view = new View("Admin/Menus/createMenus", "back");
        $form = new CreateMenu();
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValidPages())
        {
            if ($form->isValidImages($_FILES['menu_file']['tmp_name'], $_FILES['menu_file']['name']) ) {
                $menu = new MenuModel();
                $menu->setTitleMenu($_POST['menu_titlemenu']);
                $menu->setIconMenu($_POST['menu_icon']);
                $menu->setTitle($_POST['menu_title']);
                $menu->setMetaDescription($_POST['menu_meta_description']);
                $menu->setMiniature($_FILES['menu_file']['name']);
                $menu->setContent($_POST['menu_content']);
                $upload = new Upload();
                $upload->uploadFile($_FILES['menu_file']);
                $menu->save();
                $modal = [
                    "title" => "Menu creé avec succes",
                    "content" => "Le menu a bien été creé.",
                    "redirect" => "/dashboard/menus"
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

    public function menuDelete(): void
    {
        $view = new View("Admin/Pages/deletePages", "back");
        $menuID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $menu = new MenuModel();
        if ($menu->deleteMenu($menuID) == 1) {
            $modal = [
                "title" => "Menu supprimé avec succes",
                "content" => "Le menu a bien été supprimé.",
                "redirect" => "/dashboard/menus"
            ];
            $view->assign("modal", $modal);
        } else {
            $modal = [
                "title" => "Erreur lors de la suppression du menu",
                "content" => "Impossible de supprimer le menu",
                "redirect" => "/dashboard/menus"
            ];
            $view->assign("modal", $modal);
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

    public function menuUpdate(): void
    {
        $menu = new MenuModel();
        $menuID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $menuToUpdate = $menu->getOneBy(["id" => $menuID], "object");
        if($menuToUpdate)
        {
            $menuArray = $menu->getOneBy(["id" => $menuID], "array");
            $view = new View("Admin/Menus/updateMenus", "back");
            $form = new EditMenu($menuArray);
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidPages())
            {
                if ($form->isValidImages($_FILES['menu_file']['tmp_name'], $_FILES['menu_file']['name']) ) {
                    $menuToUpdate->setTitleMenu($_POST['menu_titlemenu']);
                    $menuToUpdate->setIconMenu($_POST['menu_icon']);
                    $menuToUpdate->setTitle($_POST['menu_title']);
                    $menuToUpdate->setMetaDescription($_POST['menu_meta_description']);
                    $menuToUpdate->setMiniature($_FILES['menu_file']['name']);
                    $menuToUpdate->setContent($_POST['menu_content']);
                    $upload = new Upload();
                    $upload->uploadFile($_FILES['menu_file']);
                    $menuToUpdate->save();
                    $modal = [
                        "title" => "Menu modifié avec succes",
                        "content" => "Le menu a bien été modifié.",
                        "redirect" => "/dashboard/menus"
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
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function commentsUpdate(): void
    {
        if($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur") {
            $commentID = basename(strtolower($_SERVER["REQUEST_URI"]));
            $comments = new Comment();
            $commentsToUpdate = $comments->getOneBy(["id" => $commentID], "object");

            if($commentsToUpdate) {
                $commentArray = $comments->getOneBy(["id" => $commentID], "array");
                $view = new View("Admin/Comments/commentsUpdate", "back");
                $form = new CommentUpdate($commentArray);
                $view->assign('config', $form->getConfig());
                if ($form->isSubmit() && $form->isValidCommentUpdate()) {
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
                else {
                    $view->assign('errors', $form->listOfErrors);
                }
            }
            else
            {
                $view = new View("Security/404", "front");
                $view->assign("showNavbar", "false");
            }

        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function userUpdate(): void
    {
        $user = new User();
        $userID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $userToUpdate = $user->getOneBy(["id" => $userID], "object");
        if($userToUpdate)
        {
            $userArray = $user->getOneBy(["id" => $userID], "array");
            $view = new View("Admin/Users/userUpdate", "back");
            $form = new EditUser($userArray);
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidUserCreation()) {
                $userToUpdateaccount = $userToUpdate->getOneBy(["email" => $_POST['user_email']], "object");
                if ($userToUpdateaccount && $userToUpdateaccount->getEmail() != $userToUpdate->getEmail()) {
                    $errors['user_email'] = "-L'adresse e-mail est déjà utilisée. Merci de bien vouloir renseigner une autre adresse e-mail.";
                    $view->assign('errors', $errors);
                    exit;
                } else {
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
        } else {
            $view->assign('errors', $form->listOfErrors);
        }
    }
    else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }

    }

    public function editPages(): void
    {
        $page = new PagesModel();
        $pageID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $pageToUpdate = $page->getOneBy(["id" => $pageID], "object");
        if($pageToUpdate) {
            $pageArray = $page->getOneBy(["id" => $pageID], "array");
            $view = new View("Admin/Pages/updatePages", "back");
            $form = new EditPage($pageArray);
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidPages()) {
                if ($form->isValidImages($_FILES['page_file']['tmp_name'], $_FILES['page_file']['name'])) {
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
                } else {
                    $view->assign('errors', $form->listOfErrors);
                }
            } else {
                $view->assign('errors', $form->listOfErrors);
            }
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }

    }

    public function users(): void
    {
        $view = new View("Admin/Users/usersShow", "back");
        $users = new User();
        $view->assign("users", $users->findAll());
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
        $view = new View("Admin/Users/createUser", "back");
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