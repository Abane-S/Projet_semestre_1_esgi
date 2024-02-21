<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\ContactUs;
use App\Models\PhpMailor;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;

class Main
{
    public function home(): void
    {
        $view = new View("Main/home", "front");
        $pages = new Pages();
        $view->assign("cards", $pages->getAllPages());

    }

    public function showDesignGuide():void
    {
        $view = new View("Main/DesignGuide", "front");
        $view->assign("showNavbar", "false");
    }


        public function showdesignGuideModal():void
    {
        $view = new View("Main/DesignGuide", "front");
        $view->assign("showNavbar", "false");
        $modal = [
            "title" => "Titre de la modal",
            "content" => "Message de la modal",
            "redirect" => "/DesignGuide"
        ];
        $view->assign("modal", $modal);
    }

    public function contact(): void
    {
        $form = new ContactUs();
        $view = new View("Main/contact", "front");
        $view->assign('config', $form->getConfig());
        if ($form->isSubmit() && $form->isValidEmail()) {
            $user = new User();
            $admin = $user->getOneBy(["role" => "admin"], "object");

            $phpMailer = new PhpMailor();
            $subject = $_POST['contact_subject'];
            $message = $_POST['contact_message'];
            $phpMailer->sendMail($admin->getEmail(), $subject, $message);

            $modal = [
                "title" => "Message envoyé avec succès",
                "content" => "Votre message a bien été envoyé",
                "redirect" => "/contact"
            ];
            $view->assign("modal", $modal);
        }
    }
    public function dashboard(): void 
    {

        if ($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur"){
            $view = new View("Admin/dashboard", "back");
            $user = new User();
            $view->assign("users", $user->ORMLiteSQL("SELECT"));
        }
        else {
            header('Location: /error');
        }
    }
}
