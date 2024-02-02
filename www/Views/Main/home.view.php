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
    <ul class="card-container">
        <?php
        if (!empty($cards)) {
            foreach ($cards as $card) {
            ?>
                <article class="card">
                    <img src="../../assets/Framework/public/images/totoro.jpg" />
                    <h1><?= $card['title'] ?></h1>
                    <p>
                        Some quick example text to build on the card title and make up the
                        bulk of the card's content.
                    </p>
                    <a href="<?= $card['url_page'] . $card['title'] ?>">
                        <button class="button button-primary button-md" >See the portfolio</button>
                    </a>
                </article>
            <?php } 
        } else {
            echo "<h2 class='text-center'>Il n'y a pas d'article pour le moment</h2>";
        }
        ?>
    </ul>
</div>