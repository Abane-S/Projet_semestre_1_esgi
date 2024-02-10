<?php

namespace App\Controllers;

use App\Core\View; 
use App\Core\Menu as MenuModel;

class Menu 
{

    public function menus(): void
    {
        $view = new View("Admin/Menus/menus", "back");
        $menus = new MenuModel();
        $view->assign("pages", $pages->getAllMenu());
    }


    public function create(): void 
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
}