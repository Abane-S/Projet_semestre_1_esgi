<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;

class Main
{
    public function home(): void
    {
        $view = new View("Main/home", "front");

        // $categories = new Categories();
        // var_dump($categories->findAll());
        // $view->assign("categories", $categories->findAll());
        $pages = new Pages();
        $view->assign("cards", $pages->getAllPages());
        // if (isset($_GET['category'])) {
        //     $pages = new Pages();
        //     $view->assign("pages", $pages->getPagesByCategory($_GET['category']));
        // } else {
        //     $pages = new Pages();
        //     $view->assign("pages", $pages->getAllPages());
        // }
    
    }

    public function aboutUs(): void
    {
        // echo "Ma page a propos";
        $myView = new View("Main/aboutus", "front");
    }

    public function dashboard(): void 
    {
        if ($_SESSION['Account']['role'] == "admin"){
            $view = new View("Admin/dashboard", "back");
            $user = new User();
            $view->assign("users", $user->findAll());
        }
        else {
            header('Location: /error');
        }
    }
}
