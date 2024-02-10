<article class="article-container">
    <header class="article-header">
        <img src="<?= SITE_URL . "/assets/Framework/public/images_upload/" . $pages['miniature'] ?>" alt="">
        <div class="article-header-info d-flex flex-column gap-3">
            <h1 class="fs-4"><?= $pages['title'] ?></h1>
            <span> Publié par <b><?php
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
            <?= $pages['content']?>
        </div>
    </main>
</article>