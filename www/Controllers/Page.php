<?php

namespace App\Controllers;


use App\Core\View;
use App\Forms\CommentInsert;
use App\Models\Pages;
use App\Models\Articles;
use App\Forms\CreatePage;
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
        $view->assign("pages", $pages->findAll());
    }

    public function createPage(): void
    {
        $view = new View("Dashboard/Pages/createPage", "back");
        $form = new CreatePage();
        $article = new Articles();
        $view->assign('config', $form->getConfig());
        $view->assign('articles', $article->findAll());

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['title'] != "") {
            // var_dump($_POST);
            // var_dump($_FILES);
            $page = new Pages();
            $page->setTitle($_POST['title']);
            $page->setMeta_description($_POST['meta_description']);
            $page->setTitre($_POST["titre"]);
            $page->setBanniere($_FILES['files']['name']??"");
            $page->setArticleid($_POST['article']);
            $page->setContent($_POST['content']);
            $upload = new Upload();
            $upload->uploadFile($_FILES['files']);
            $page->save();

        }
    }

    public function showPage(): void
    {
        $articleId = basename(strtolower($_SERVER["REQUEST_URI"]));
        $view = new View("Dashboard/Pages/show", "front");
        $page = new Pages();
        $current_page = $page->getOneBy(["id"=>$articleId]);
        if($current_page) {
            $view->assign("pages", $current_page);
            $current_page_obj = $page->getOneBy(["id"=>$articleId], "object");
            if($current_page_obj->getComments() && Security::UserIsLogged())
            {
                $form = new CommentInsert();
                $view2 = new View("Dashboard/Pages/comments", "blank");
                $view2->assign('config', $form->getConfig());
                $view2->assign("showNavbar", "false");
                $view2->assign("articleId", $articleId);

                if ($form->isSubmit() && $form->isValidComment()) {
                    $comment = new Comment();
                    $comment->setIdPage($articleId);
                    $comment->setFullname($_SESSION['Account']['lastname'] . " " . $_SESSION['Account']['firstname']);
                    $comment->setComment($_POST['comment']);
                    $comment->setCommenttitle($_POST['comment_title']);
                    $comment->setValid(0);
                    $comment->save();
                    $phpMailer = new PhpMailor();
                    $subject = "Commentaire actuellemnt en cours de modération";
                    $message = "<p>Votre commentaire est actuellement en cours de modération.<br>Vous serez averti(e) par e-mail lors de sa publication.</p>";
                    $phpMailer->sendMail($_SESSION['Account']['email'], $subject, $message);
                    $user = new User();
                    $moderateur = $user->ShowAllModerate();
                    if (is_array($moderateur) && !empty($moderateur)) {
                        foreach ($moderateur as $moderateur_email) {
                            $phpMailer = new PhpMailor();
                            $subject = "Un nouveau commentaire à modererer est disponible.";
                            $message = "Un nouveau commentaire est disponible sur la page n°<b>" . $articleId . "</b>" .
                                ": <br><br>" .
                                "Nom complet : <b>" . $_SESSION['Account']['lastname'] . " " . $_SESSION['Account']['firstname'] . "</b>" .
                                "<br>Titre du commentaire : <b>" . $_POST['comment'] . "</b>" .
                            "<br>Commentaire : <b>" . $_POST['comment_title'] . "</b>" .
                                "<br>Date et heure de publication : <b>" . date("Y-m-d H:i:s") . "</b>" . "<br><br>" .
                                '<a href="#" style="    display: inline-block;
                                    font-weight: 500;
                                    letter-spacing: 0.05rem;
                                    font-size: 1rem;
                                    border: none;
                                    background-color: #28a745;
                                    border-radius: 0.375rem;
                                    padding: 0.300rem 1rem;
                                    color: white;
                                    cursor: pointer;
                                    text-align: center;
                                width: 27%;
                                text-decoration: none;" class="">Valider le commentaire</a>' . "   " .
                                                            '<a href="#" style="
                                    display: inline-block;
                                    font-weight: 500;
                                    letter-spacing: 0.05rem;
                                    font-size: 1rem;
                                    border: none;
                                    text-align: center;
                                    background-color: #dc3545;
                                    border-radius: 0.375rem;
                                    padding: 0.300rem 1rem;
                                    color: white;
                                    cursor: pointer;
                                width: 27%;
                                text-decoration: none;">Ne pas valider le commentaire</a>';
                            $phpMailer->sendMail($moderateur_email, $subject, $message);
                        }
                    } else {
                        $admin = $user->getOneBy(["role" => "admin"], "object");
                        $subject = "Un commentaire a été publié sur votre site mais vous n'avez pas créé de modérateur";
                        $message = "<p>Vous pouvez créer ou attribuer le rôle de modérateur à partir de votre tableau de bord.</p>";
                        $phpMailer->sendMail($admin->getEmail(), $subject, $message);
                    }

                    $modal = [
                        "title" => "Commentaire en attente de modération",
                        "content" => "Votre commentaire est actuellement en cours de modération.<br>Vous serez averti(e) par e-mail lors de sa publication.",
                        "redirect" => "/"
                    ];
                    $view->assign("modal", $modal);

                }
            }
            else if($current_page_obj->getComments() && !Security::UserIsLogged())
            {
                echo '<style>#needtologin { display: flex !important; }</style>';
            }
        }
        else
        {
            $view = new View("Security/404", "front");
            $view->assign("showNavbar", "false");
            exit;
        }
    }

    public function editPage(): void
    {

    }
}