<article class="article-container">
    <header class="article-header">
        <img src="<?= "http://localhost:8081/assets/Framework/public/images_upload/" . $pages['miniature'] ?>" alt="">
        <div class="article-header-info d-flex flex-column gap-3">
            <h1 class="fs-4"><?= $pages['title'] ?></h1>
            <span> Publié par <b><?php  echo "Abane Sebiane" // mettre la constante ADMIN_NAME ADMIN_FIRSTNAME ?></b> le &nbsp;
            <time> <?php $parts = explode(" " , $pages['created_at']);   echo $parts[0];?></time></span>
        </div>
    </header>
    <main>
        <div class="article-content">
            <?= $pages['content']?>
        </div>
    </main>
</article>