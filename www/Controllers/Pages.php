<?php

namespace App\Controllers;


use App\Core\View;
use App\Models\Pages as PagesModel;
use App\Forms\CreatePage;

class Pages
{


    public function index(): void
    {
        $view = new View("Admin/Pages/index", "back");
        $pages = new PagesModel();
        $view->assign("pages", $pages->getAllPages());
    }

    public function create(): void
    {
        $view = new View("Admin/Pages/create", "back");
        $form = new CreatePage();
        $view->assign('config', $form->getConfig());
    }
}