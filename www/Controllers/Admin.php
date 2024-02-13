<?php

namespace App\Controllers;

use App\Core\View;
use App\FileStorage\Upload;
use App\Forms\CreatePage;
use App\Forms\CreateUser;
use App\Forms\UserInsert;
use App\Models\Pages as PagesModel;
use App\Models\User;
use App\Models\Categories;
use App\Models\Pages;
use App\Models\Comments;
use App\Forms\CommentUpdate;

class Comment
{
    public function pages(): void
    {
        $view = new View("Admin/pages", "back");
        $pages = new Pages();
        $view->assign("pages", $pages->getAllPages());
    }

    public function commentsUpdate(): void
    {
        if($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur") {
            $commentID = basename(strtolower($_SERVER["REQUEST_URI"]));
            $form = new CommentUpdate();
            $view = new View("Admin/Comments/commentsUpdate", "back");
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidCommentUpdate())
            {
                $comments = new Comment();
                $commentsToUpdate = $comments->getOneBy(["id" => $commentID], "object");
                if($commentsToUpdate)
                {
                    $commentsToUpdate->setValid($_POST["comment_valid"]);
                    $commentsToUpdate->setCommenttitle($_POST["comment_title"]);
                    $commentsToUpdate->setComment($_POST["comment"]);
                    $commentsToUpdate->save();
                    $view = new View("Admin/Comments/commentsDelete", "back");
                    $modal = [
                        "title" => "Comments modifier avec succes",
                        "content" => "Le commentaire a bien été modifier.",
                        "redirect" => "/dashboard/comments"
                    ];
                    $view->assign("modal", $modal);
                }
                else
                {
                    $view = new View("Admin/Comments/commentsDelete", "back");
                    $modal = [
                        "title" => "Erreur lors de la modification du commentaire",
                        "content" => "Impossible de modifier ce commentaire",
                        "redirect" => "/dashboard/comments"
                    ];
                    $view->assign("modal", $modal);
                }
            }
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function commentsDelete(): void
    {
        if($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur") {
            $commentID = basename(strtolower($_SERVER["REQUEST_URI"]));
            $comments = new Comment();
            if ($comments->deleteComment($commentID) == 1) {
                $view = new View("Admin/Comments/commentsDelete", "back");
                $modal = [
                    "title" => "Comments supprimer avec succes",
                    "content" => "Le commentaire a bien été supprimé.",
                    "redirect" => "/dashboard/comments"
                ];
                $view->assign("modal", $modal);
            } else {
                $view = new View("Admin/Comments/commentsDelete", "back");
                $modal = [
                    "title" => "Erreur lors de la suppression du commentaire",
                    "content" => "Impossible de supprimer ce commentaire",
                    "redirect" => "/dashboard/comments"
                ];
                $view->assign("modal", $modal);
            }
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
        }
    }

    public function comments(): void
    {
        $view = new View("Admin/Comments/commentsShowAdmin", "back");
        $comments = new Comments();
        $view->assign("comments", $comments->findAll());
    }
}