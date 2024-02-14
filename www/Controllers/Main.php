<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\ContactUs;
use App\Models\PhpMailor;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Articles;

class Main
{
    public function home(): void
    {
        $view = new View("Main/home", "front");
        $article = new Articles();
        $articles = $article->findAll();
        if (is_array($articles) && !empty($articles)) 
            $view->assign("cards", $article->findAll());
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
    public function aboutUs(): void
    {
        // echo "Ma page a propos";
        $myView = new View("Main/aboutus", "front");
    }

    public function dashboard(): void 
    {

        if ($_SESSION['Account']['role'] == "admin"){
            $view = new View("Dashboard/Dashboard", "back");
            $user = new User();
            $view->assign("users", $user->findAll());
        }
        else {
            header('Location: /error');
        }
    }
}
