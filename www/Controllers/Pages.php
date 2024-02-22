<?php

namespace App\Controllers;


use App\Core\View;
use App\Forms\CommentInsert;
use App\Models\Pages as PagesModel;
use App\Models\Comment;
use App\Models\PhpMailor;
use App\Models\User;

class Pages
{
    public function show(): void
    {
        $articleId = basename(strtolower($_SERVER["REQUEST_URI"]));
        $page = new PagesModel();
        $current_page = $page->getOneBy(["id"=>$articleId]);
        if($current_page) {
            $view = new View("Admin/Pages/showPage", "front");
            $view->assign("pages", $current_page);
            $current_page_obj = $page->getOneBy(["id"=>$articleId], "object");
            if($current_page_obj->getComments() && Security::UserIsLogged())
            {
                $form = new CommentInsert();
                $view2 = new View("Admin/Comments/commentsShowArticle", "front");
                $view2->assign('config', $form->getConfig());
                $view2->assign("showNavbar", "false");
                $comment = new Comment();
                $view2->assign("comments", $comment->ShowAllValidComments($articleId));

                if ($form->isSubmit() && $form->isValidComment()) {
                    $comment->setIdPage($articleId);
                    $comment->setFullname($_SESSION['Account']['lastname'] . " " . $_SESSION['Account']['firstname']);
                    $comment->setComment(htmlspecialchars($_POST['comment']));
                    $comment->setCommenttitle(htmlspecialchars($_POST['comment_title']));
                    $comment->setValid(0);
                    $comment->save();
                    $phpMailer = new PhpMailor();
                    $subject = "Comments actuellemnt en cours de modération";
                    $message = "<p>Votre commentaire est actuellement en cours de modération.<br>Vous serez averti(e) par e-mail lors de sa publication.</p>";
                    $phpMailer->sendMail($_SESSION['Account']['email'], $subject, $message);
                    $user = new User();
                    $moderateur = $user->ORMLiteSQL("SELECT", "role", "moderateur");
                    $moderateur = array_column($moderateur, 'email');
                    if (is_array($moderateur) && !empty($moderateur)) {
                        foreach ($moderateur as $moderateur_email) {
                            $phpMailer = new PhpMailor();
                            $subject = "Un nouveau commentaire à modererer est disponible.";
                            $message = "Un nouveau commentaire est disponible sur la page n°<b>" . $articleId . "</b>" .
                                ": <br><br>" .
                                "Nom complet : <b>" . $_SESSION['Account']['lastname'] . " " . $_SESSION['Account']['firstname'] . "</b>" .
                                "<br>Titre du commentaire : <b>" . $_POST['comment'] . "</b>" .
                            "<br>Comments : <b>" . $_POST['comment_title'] . "</b>" .
                                "<br>Date et heure de publication : <b>" . date("Y-m-d H:i:s") . "</b>" . "<br><br>" .
                                '<a href="' . (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/dashboard/comments" style="    display: inline-block;
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
text-decoration: none;" class="">Moderer le commentaire</a>';
                            $phpMailer->sendMail($moderateur_email, $subject, $message);
                        }
                    } else {
                        $admin = $user->getOneBy(["role" => "admin"], "object");
                        $subject = "Un commentaire a été publié sur votre site mais vous n'avez pas créé de modérateur";
                        $message = "<p>Vous pouvez créer ou attribuer le rôle de modérateur à partir de votre tableau de bord.</p>";
                        $phpMailer->sendMail($admin->getEmail(), $subject, $message);
                    }

                    $modal = [
                        "title" => "Comments en attente de modération",
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
}