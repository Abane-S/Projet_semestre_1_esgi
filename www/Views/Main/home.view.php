<div class="card-container-base">
    <!-- <h2>Les catégories</h2>
    <ul class="list-group">
        <?php
        // foreach ($categories as $category) {
        //     echo "<button class='list-group-item' onclick=\"window.location.href='/?category=" . $category["name"] . "'\">" . $category["name"] . "</button>";
        // }
        ?>
        <button style="display: inline" onclick="window.location.href='/'">Toutes les pages</button>
    </ul> -->
    <h1 class="ml-3 mt-5 mb-6" >Pages</h1>
        <?php
        if (!empty($cards)) { ?>
            <ul class="card-container">
            <?php foreach ($cards as $card) { ?>
                    <article class="card">
                        <img src="<?= SITE_URL . "/assets/Framework/public/images_upload/" . $card['miniature'] ?>">
                        <h1><?= $card['title'] ?></h1>
                        <p>
                            <?= $card['meta_description'] ?>
                        </p>
                        <a href="/page/<?= $card['id']; ?>">
                            <button class="w-10 button button-primary button-md w-" >Voir la page</button>
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