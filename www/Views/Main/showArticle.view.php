<article class="article-container">
    <header class="article-header">
        <img src="<?= SITE_URL . "/assets/Framework/public/images_upload/" . $article['miniature'] ?>" alt="">
        <div class="article-header-info d-flex flex-column gap-3">
            <h1 class="fs-4"><?= $article['titre'] ?></h1>
            <span> Publié par <b> <?php //$article['firstname_author'] $article['lastname_author'] insert bdd?> </b> le
            <time> <?php $parts = explode(" " , $article['created_at']);   echo $parts[0];?></time></span>
        </div>
    </header>
    <main>
        <div class="article-content">
            <?= $article['content']?>
        </div>
    </main>
    <footer>
        
    </footer>
</article>

<?php
if (isset($modal)) {
    $this->includeComponent("modal", $modal);
}
?>

<p id ="needtologin" style="display:none; text-align: center;
    justify-content: center;
    color: red;">
    Merci de vous connecter ou de vous inscrire<br>afin d'afficher les commentaires disponibles ou pour en ajouter.
</p>