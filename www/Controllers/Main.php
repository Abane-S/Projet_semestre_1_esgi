<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\User;

class Main
{
    public function home(): void
    {
        /*
        $myPage = new Page();
        $myPage->setTitle("MA super page");
        $myPage->setDesc("Description de ma super page");
        $myPage->save();
        */

        $myView = new View("Main/home", "front");
    }

    public function aboutUs(): void
    {
        // echo "Ma page a propos";
        $myView = new View("Main/aboutus", "front");
    }

    public function dashboard(): void 
    {
        if ($_SESSION['Account']['role'] == "admin"){
            $view = new View("Admin/Dashboard", "back");
            $user = new User();
            $view->assign("users", $user->findAll());
        }
        else {
            header('Location: /error');
        }
    }
}
