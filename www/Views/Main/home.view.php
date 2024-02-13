<div>
    <h1 class="ml-23 mt-5 mb-6 " >Pages</h1>
    <?php
    if (!empty($cards)) { ?>
        <ul class="card-container" >
        <?php foreach ($cards as $card) { ?>
                <article class="card">
                    <img src="<?= SITE_URL . "/assets/Framework/public/images_upload/" . $card['miniature'] ?>">
                    <h1><?= $card['titre'] ?></h1>
                    <p>
                        <?= $card['description'] ?>
                    </p>
                    <a href="/article/<?= $card['id']; ?>">
                        <button class="w-10 button button-primary button-md w-" >Voir l'article</button>
                    </a>
                </article>
        <?php } 
        ?>
        </ul>
    <?php
    } else {
        echo "<h2 class='text-center pt-5'>Il n'y a pas d'article pour le moment</h2>";
    }
    ?>
</div>