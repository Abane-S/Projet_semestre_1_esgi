<div class="container">
    <h2>Les catégories</h2>
    <ul class="list-group">
        <?php
        // foreach ($categories as $category) {
        //     echo "<button class='list-group-item' onclick=\"window.location.href='/?category=" . $category["name"] . "'\">" . $category["name"] . "</button>";
        // }
        ?>
        <button class='button_style' onclick="window.location.href='/'">Toutes les pages</button>
    </ul>
    <h2>Les Pages <?php  
    //si on a une catégorie dans l'url on affiche le nom de la catégorie
    if(isset($_GET['category'])){
        echo "de la catégorie " . $_GET['category'];
    }
    ?></h2>
    <ul class="card-container">
        <?php
        foreach ($cards as $card) {
        ?>
            <article class="card">
                <img src="assets/images/totoro.jpg" />
                <h1><?= $card['title'] ?></h1>
                <p>
                    Some quick example text to build on the card title and make up the
                    bulk of the card's content.
                </p>
                <a href="<?= $card['url_page'] . $card['title'] ?>" >
                    <button class="button button-primary" >See the portfolio</button>
                </a>
            </article>
        <?php } ?>
    </ul>
</div>