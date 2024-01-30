<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Menu;
use App\Models\Comments;

class Admin
{
    public function pages(): void
    {
        $view = new View("Admin/pages", "back");
        $pages = new Pages();
        $view->assign("pages", $pages->getAllPages());
    }

    public function users(): void
    {
        $view = new View("Admin/users", "back");
        $users = new User();
        var_dump($users->getAllUsers());
        $view->assign("users", $users->getAllUsers());
    }

    public function menus(): void
    {
        $view = new View("Admin/menus", "back");
        $categories = new Menu();
        $view->assign("menu", $categories->getAllMenu());
    }

    public function comments(): void
    {
        $view = new View("Admin/comments", "back");
        $comments = new Comments();
        $view->assign("comments", $comments->getAllComments());
    }
}