<article class="article-container">
    <header class="article-header">
        <img src="<?= SITE_URL . "/assets/Framework/public/images_upload/" . $pages['miniature'] ?>" alt="">
        <div class="article-header-info d-flex flex-column gap-3">
            <h1 class="fs-4"><?= $pages['title'] ?></h1>
            <span id="publier-par"> Publié par <b><?php
                    use App\Models\User;
                    $user = new User();
                    $admin = $user->getOneBy(["role" => "admin"], "object");
                    if ($admin) { 
                        echo $admin->getFirstname() . " " . $admin->getLastname();
                    }
                    ?></b> le
            <time> <?php $parts = explode(" " , $pages['created_at']);   echo $parts[0];?></time></span>
        </div>
    </header>
    <main>
        <div class="article-content">
            <meta name="description" content="<?= $pages['meta_description'] ?>">
            <?= $pages['content']?>
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