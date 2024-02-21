<?php

namespace App\Controllers;


use App\Core\View;
use App\Forms\CommentInsert;
use App\Models\Menus as MenusModel;
use App\Models\Comment;
use App\Models\PhpMailor;
use App\Models\User;

class Menus
{
    public function show(): void
    {
        $articleId = basename(strtolower($_SERVER["REQUEST_URI"]));
        $page = new MenusModel();
        $current_page = $page->getOneBy(["id"=>$articleId]);
        if($current_page) {
            $view = new View("Admin/Pages/showPage", "front");
            $view->assign("pages", $current_page);
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
            exit;
        }
    }
}