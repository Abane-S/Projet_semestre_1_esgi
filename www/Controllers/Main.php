<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\User;

class Main
{
    public function home(): void
    {
        $myUser = new User();
        $myUser->setFirstname("YVEs");
        $myUser->setLastname("Skrzypczyk  ");
        $myUser->setEmail("Y.skrzypczyk@gmail.com");
        $myUser->setPassword("Test1234");
        $myUser->setStatus(1);
        $myUser->save();

        //$myUser = User::populate(1);
        //$myUser->setLastname("yo");
        //$myUser->save();

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
}
