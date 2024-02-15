<?php

namespace App\Controllers;


use App\Core\View;
use App\Forms\CommentInsert;
use App\Models\Pages;
use App\Models\Articles;
use App\Forms\createPage;
use App\FileStorage\Upload;
use App\Models\Comments;
use App\Models\PhpMailor;
use App\Models\Users;

class Page
{


    public function showAllPages(): void
    {
        $view = new View("Dashboard/Pages/showAllPages", "back");
        $pages = new Pages();
        $view->assign("pages", $pages->findAll("id", "ASC"));
    }

    public function createPage(): void
    {
        $view = new View("Dashboard/Pages/createPage", "back");
        $form = new createPage();
        $article = new Articles();
        $view->assign('config', $form->getConfig());
        $view->assign('articles', $article->findAll());

        if ($form->isSubmit() && $form->isValid()) {
            $page = new Pages();
            $page->setTitle($_POST['title']);
            $page->setMeta_description($_POST['meta_description']);
            $page->setTitre($_POST["titre"]);
            $page->setMenu($_POST['menu']);
            $page->setBanniere($_FILES['images']['name']??"");
            $page->setArticleid($_POST['article']);
            if ($_POST['article'] == "-1")
                $page->setContent($_POST['content']);
            else
                $page->setContent("");

            $upload = new Upload();
            $upload->uploadFile($_FILES['images']);
            $page->save();

            $modal = [
                "title" => "Page créer avec succès !",
                "content" => "La page a bien été créer. Vous pouvez maintenant la consulter sur le site.",
                "redirect" => "/dashboard/pages"
            ];

        }else{
            $view->assign('errors', $form->listOfErrors);
        }
    }

    public function showPage(): void
    {
        $articleId = basename(strtolower($_SERVER["REQUEST_URI"]));
        $view = new View("Main/showArticle", "front");
        $page = new Pages();
        $current_page = $page->getOneBy(["id"=>$articleId]);
        if($current_page) {
            $view->assign("pages", $current_page);
            $current_page_obj = $page->getOneBy(["id"=>$articleId], "object");
        } else {
            $view->assign("pages", $page->getOneBy(["titre"=>$articleId]));
            $current_page_obj = $page->getOneBy(["titre"=>$articleId], "object");
        }
    }

    public function editPage(): void
    {
        if (isset($_GET[0])){
            $pageId = $_GET[0];
            $page = new Pages();
            $page = $page->getOneBy(["id" => $pageId], "table");
            if ($page)
            {  
                $view = new View("Dashboard/Pages/createPage", "back");
                $form = new createPage();
                $article = new Articles();
                $view->assign('config', $form->getConfig());
                $view->assign('page', $page);
                $view->assign('articles', $article->findAll());

                if ($form->isSubmit() && $form->isValid()){
                    $page = new Pages();
                    $page->setId($pageId);
                    $page->setTitle($_POST['title']);
                    $page->setMeta_description($_POST['meta_description']);
                    $page->setTitre($_POST["titre"]);
                    $page->setMenu($_POST['menu']);
                    $page->setBanniere($_FILES['images']['name']??"");
                    $page->setArticleid($_POST['article']);
                    if ($_POST['article'] == -1) {
                        $page->setContent($_POST['content']);
                    }
                    $page->setContent("");
        
                    $upload = new Upload();
                    $upload->uploadFile($_FILES['images']);
                    $page->save();
                    
                    $modal = [
                        "title" => "Page modifier avec succès !",
                        "content" => "La page a bien été modifier. Vous pouvez maintenant la consulter sur le site.",
                        "redirect" => "/dashboard/pages"
                    ];
                    $view->assign("modal", $modal);
                }else{
                    $view->assign('errors', $form->listOfErrors);
                }
            }else{
                $modal = [
                    "title" => "Page introuvable !",
                    "content" => "La page que vous souhaitez modifier n'existe pas.",
                    "redirect" => "/dashboard/pages"
                ];
                $view = new View("Dashboard/pages/showAllUsers", "back");
                $view->assign("pages", $page->findAll());
                $view->assign("modal", $modal);
            }   
        }
    }

    public function deletePage(): void
    {
        if (isset($_GET[0])) {
            $pageId = $_GET[0];
            $page = new Pages();
            $page = $page->getOneBy(["id" => $pageId], "object");
            if ($page) {
                $modal = [
                    "title" => "Suppression de page",
                    "content" => "Êtes-vous sûr(e) de vouloir supprimer cette page ?",
                    "button-message" => "Supprimer",
                    "button-color" => "danger",
                    "redirect" => "/dashboard/pages/confirmDeletePage/$pageId",
                    "second-button-redirect" => "/dashboard/pages",
                    "second-button" => "Annuler",
                ];
                $view = new View("Dashboard/pages/showAllPages", "back");
                $view->assign("pages", $page->findAll());
                $view->assign("modal", $modal);
            }
            else {
                $modal = [
                    "title" => "Page introuvable !",
                    "content" => "La page que vous souhaitez supprimer n'existe pas.",
                    "redirect" => "/dashboard/pages"
                ];
                $view = new View("Dashboard/pages/showAllPages", "back");
                $view->assign("pages", $page->findAll());
                $view->assign("modal", $modal);
            }
        }
    }

    public function confirmDeletePage() {
        if (isset($_GET[0])) {
            $pageId = $_GET[0];
            $page = new Pages();
            $page = $page->getOneBy(["id" => $pageId], "object");
            if ($page) {
                $page->setId($pageId);
                $page->delete();
                header("Location: /dashboard/pages");
                exit;
            }else {
                $modal = [
                    "title" => "Page introuvable !",
                    "content" => "La page que vous souhaitez supprimer n'existe pas.",
                    "redirect" => "/dashboard/pages"
                ];
                $view = new View("Dashboard/pages/showAllPages", "back");
                $view->assign("pages", $page->findAll());
                $view->assign("modal", $modal);
            }
        }
    }
}