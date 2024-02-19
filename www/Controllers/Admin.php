<?php

namespace App\Controllers;

use App\Core\View;
use App\FileStorage\Upload;
use App\Forms\CreatePage;
use App\Forms\CreateMenu;
use App\Forms\CreateUser;
use App\Forms\EditPage;
use App\Forms\EditTemplate;
use App\Forms\EditUser;
use App\Forms\EditMenu;
use App\Models\Pages as PagesModel;
use App\Models\Menus as MenuModel;
use App\Models\Templates;
use App\Models\Templates as TemplateModel;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Comment;
use App\Forms\CommentUpdate;
use App\Forms\CreateTemplate;

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
            $_SESSION['GetSelectedCurrentOption'] = str_replace(' ', '', $menuToUpdate->getIconMenu());
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
                    $_SESSION['GetSelectedCurrentOption'] = "none";
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
                    $_SESSION['GetSelectedCurrentOption'] = "none";
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

    public function showTemplate(): void
    {
        $view = new View("Admin/Template/showTemplate", "back");
        $template = new TemplateModel();
        $view->assign("templates", $template->getAllTemplate());
    }

    public function deleteTPL(): void
    {
        $tplID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $tpl = new Templates();
        $tplCheck = $tpl->getOneBy(["id" => $tplID], "object");
        if($tplCheck)
        {
            $view = new View("Admin/Template/deleteTemplate", "back");
            if ($tplCheck->getActive() == 0) {
                if ($tplCheck->getDefaultTpl() == 0) {
                    if ($tplCheck->deleteTPL($tplID) == 1) {
                        $modal = [
                            "title" => "Template supprimer avec succes",
                            "content" => "Le template a bien été supprimé.",
                            "redirect" => "/dashboard/template"
                        ];
                        $view->assign("modal", $modal);
                    } else {
                        $modal = [
                            "title" => "Erreur lors de la suppression du template",
                            "content" => "Impossible de supprimer le template",
                            "redirect" => "/dashboard/template"
                        ];
                        $view->assign("modal", $modal);
                    }
                } else {
                    $modal = [
                        "title" => "Impossible de supprimer ce template",
                        "content" => "Impossible de supprimer ce modèle car il s'agit d'un modèle par défaut qui a été installé lors de la création du site.",
                        "redirect" => "/dashboard/template"
                    ];
                    $view->assign("modal", $modal);
                }
            } else {
                $modal = [
                    "title" => "Impossible de supprimer ce template",
                    "content" => "Impossible de supprimer ce template car il est actuellement actif.<br><br>Veuillez appliquer un autre template avant.",
                    "redirect" => "/dashboard/template"
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

    public function editTPL(): void
    {
        $tplID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $tpl = new Templates();
        $tplToUpdate = $tpl->getOneBy(["id" => $tplID], "object");
        if($tplToUpdate)
        {
            $view = new View("Admin/Template/editTemplate", "back");
            $tplArray = $tpl->getOneBy(["id" => $tplID], "array");
            $form = new EditTemplate($tplArray);
            $_SESSION['GetSelectedCurrentOption'] = $tplToUpdate->getPoliceName();
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit())
            {
                $tplToUpdate->setName($_POST['style_name']);
                $tplToUpdate->setPoliceName($_POST['style_police']);
                $tplToUpdate->setPoliceSize(intval($_POST['style_size']));
                $tplToUpdate->setBackgroundColor($_POST['style_background_color']);
                $tplToUpdate->setTextColor($_POST['style_text_color']);
                $tplToUpdate->setNavbarColor($_POST['style_navbar_color']);
                $tplToUpdate->setMenuColor($_POST['style_navbar2_color']);
                $tplToUpdate->save();
                $_SESSION['GetSelectedCurrentOption'] = "none";
                $modal = [
                    "title" => "Template modifié avec succès !",
                    "content" => "Le template a été modifié avec succès.",
                    "redirect" => "/dashboard/template"
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
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function createTemplate(): void
    {
        $view = new View("Admin/Template/createTemplate", "back");
        $form = new CreateTemplate();
        $view->assign('config', $form->getConfig());
        if ($form->isSubmit())
        {
            $style = new Templates();
            $style->setName($_POST['style_name']);
            $style->setPoliceName($_POST['style_police']);
            $style->setPoliceSize(intval($_POST['style_size']));
            $style->setBackgroundColor($_POST['style_background_color']);
            $style->setTextColor($_POST['style_text_color']);
            $style->setNavbarColor($_POST['style_navbar_color']);
            $style->setMenuColor($_POST['style_navbar2_color']);
            $style->save();
            $modal = [
                "title" => "Template crée avec succès !",
                "content" => "Le template a été crée avec succès.",
                "redirect" => "/dashboard/template"
            ];
            $view->assign("modal", $modal);
        }
        else
        {
            $view->assign('errors', $form->listOfErrors);
        }
    }

    public function setTemplate(): void
    {
        $tplID = basename(strtolower($_SERVER["REQUEST_URI"]));
        $tpl = new Templates();
        $tplToSet = $tpl->getOneBy(["id" => $tplID], "object");
        if($tplToSet)
        {
            $view = new View("Admin/Template/setTemplate", "back");
            $tplToUnset = $tpl->getOneBy(["active" => 1], "object");
            $tplToUnset->setActive(0);
            $tplToUnset->save(0);

            $tplToSet->setActive(1);
            $tplToSet->save(1);
            $modal = [
                "title" => "Template activé avec succes",
                "content" => "La template a été activé.",
                "redirect" => "/dashboard/template"
            ];
            $view->assign("modal", $modal);

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
            $_SESSION['GetSelectedCurrentOption'] = $pageToUpdate->getComments();
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
                        $_SESSION['GetSelectedCurrentOption'] = "none";
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