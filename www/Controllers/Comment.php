<?php 


namespace App\Controllers;

use App\Models\Comments;
use App\Core\View;


class Comment
{
    public function showAllComments(): void
    {
        $view = new View("Dashboard/Comments/showAllcomments", "back");
        $comment = new Comments();
        $view->assign("comments", $comment->findAll());
    }
}