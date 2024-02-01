<?php

namespace App\Controllers;

use App\Core\View; 
use App\Core\Menu as MenuModel;

class Menu 
{

    public function index(): void
    {
        $view = new View("Admin/Pages/index", "back");
        $menus = new MenuModel();
        $view->assign("pages", $pages->getAllMenu());
    }


    public function create(): void 
    {
        $view = new View("Admin/Pages/create", "back");
    }
}