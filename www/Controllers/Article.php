<?php

namespace App\Controllers;


use App\Core\View;
use App\Forms\CommentInsert;
use App\Models\Articles;
use App\Forms\createArticle;
use App\FileStorage\Upload;
use App\Models\Comments;
use App\Models\PhpMailor;
use App\Models\Users;

class Article
{


    public function showAllArticles(): void
    {
        $view = new View("Dashboard/Articles/showAllArticles", "back");
        $article = new Articles();
        $view->assign("articles", $article->findAll());
    }

    public function showArticle(): void
    {
        $articleId = $_GET[0];
        $view = new View("Main/showArticle", "front");
        $article = new Articles();
        $article = $article->getOneBy(["id"=>$articleId], "table");
        $view->assign("article", $article);
        if($article) {
            if($article['comments'] && Security::UserIsLogged())
            {
                $form = new CommentInsert();
                $view2 = new View("Dashboard/Articles/comments", "blank");
                $view2->assign('config', $form->getConfig());
                $view2->assign("showNavbar", "false");
                $view2->assign("articleId", $articleId);

                if ($form->isSubmit() && $form->isValidComment()) {
                    $comment = new Comments();
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
            else if($article['comments'] && !Security::UserIsLogged())
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


    public function createArticle(): void
    {
        $view = new View("Dashboard/articles/createArticle", "back");
        $form = new CreateArticle();
        $view->assign('config', $form->getConfig());

        if ($form->isSubmit() && $form->isValid()) {
            $article = new Articles();
            $article->setIdUser($_SESSION['Account']['id']);
            $article->setTitre($_POST['titre']);
            $article->setDescription($_POST['description']);
            $article->setMiniature($_FILES['images']['name']??"");
            $article->setComments(isset($_POST['comments']) ? 1 : 0);
            $article->setContent($_POST['content']);
            $upload = new Upload();
            $upload->uploadFile($_FILES['images']);
            $article->save();
        }
    }

    public function editArticle(): void
    {
        if (isset($_GET[0])){
            $articleId = $_GET[0];
            $article = new Articles();
            $article = $article->getOneBy(["id" => $articleId]);
            if ($article)
            {
                $view = new View("Dashboard/articles/editArticle", "back");
                $article['submit'] = "Modifier";
                $form = new CreateArticle($article);
                $view->assign("config", $form->getConfig());
                $view->assign("title", "Modifier un article");

                if ($form->isSubmit() && $form->isValid()){
                    $article = new Articles();
                    $article->setId($articleId);
                    $article->setIdUser($_SESSION['Account']['id']);
                    $article->setTitre($_POST['titre']);
                    $article->setDescription($_POST['description']);
                    $article->setMiniature($_FILES['images']['name']??"");
                    $article->setComments(isset($_POST['comments']) ? 1 : 0);
                    $article->setContent($_POST['content']);
                    $upload = new Upload();
                    $upload->uploadFile($_FILES['images']);
                    $article->save();
                    
                    $modal = [
                        "title" => "Données modifiées avec succès !",
                        "content" => "L'article a été modifié avec succès. Vous pouvez maintenant le consulter sur le site.",
                        "redirect" => "/dashboard/articles"
                    ];
                    $view->assign("modal", $modal);
                }
            }else{
                $view->assign('errors', $form->listOfErrors);
            }
        }else{
            $modal = [
                "title" => "Article Introuvable !",
                "content" => "L'article que vous souhaitez modifier n'existe pas.",
                "redirect" => "/dashboard/articles"
            ];
            $view = new View("Dashboard/Articles/showAllArticles", "back");
            $article = new Articles();
            $view->assign("articles", $article->findAll());
        }   
    }

    public function deleteArticle(): void
    {
        if (isset($_GET[0])) {
            $articleId = $_GET[0];
            $article = new Articles();
            $account = $article->getOneBy(["id" => $articleId]);
            if ($account) {
                $modal = [
                    "title" => "Suppression de l'article",
                    "content" => "Êtes-vous sûr(e) de vouloir supprimer cette article ?",
                    "button-message" => "Supprimer",
                    "button-color" => "danger",
                    "redirect" => "/dashboard/users/confirmDeleteUser/$articleId",
                    "second-button-redirect" => "/dashboard/articles",
                    "second-button" => "Annuler",
                ];
                // $user->delete($userId);
                $view = new View("Dashboard/Articles/showAllArticles", "back");
                $article = new Articles();
                $view->assign("articles", $article->findAll());
                $view->assign("modal", $modal);
            }
            else {
                $modal = [
                    "title" => "Utilisateur introuvable !",
                    "content" => "L'utilisateur que vous souhaitez supprimer n'existe pas.",
                    "redirect" => "/dashboard/users"
                ];
                $view = new View("Dashboard/Articles/showAllArticles", "back");
                $article = new Articles();
                $view->assign("articles", $article->findAll());
                $view->assign("modal", $modal);
            }
        }
        
    }
}
