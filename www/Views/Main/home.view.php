<div class="container">
    <!-- <h2>Les catégories</h2>
    <ul class="list-group">
        <?php
        // foreach ($categories as $category) {
        //     echo "<button class='list-group-item' onclick=\"window.location.href='/?category=" . $category["name"] . "'\">" . $category["name"] . "</button>";
        // }
        ?>
        <button style="display: inline" onclick="window.location.href='/'">Toutes les pages</button>
    </ul> -->
    <h2 class="ml-3 mt-5 mb-6" >Les Pages</h2>
        <?php
        if (!empty($cards)) { ?>
            <ul class="card-container">
            <?php foreach ($cards as $card) { ?>
                    <article class="card">
                        <img src="<?= "http://localhost:8081/assets/Framework/public/images_upload/" . $card['miniature'] ?>" style="object-fit: contain;">
                        <h1><?= $card['title'] ?></h1>
                        <p>
                            <?= $card['meta_description'] ?>
                        </p>
                        <a href="/article/<?= $card['id']; ?>">
                            <button class="button button-primary button-md" >See the portfolio</button>
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