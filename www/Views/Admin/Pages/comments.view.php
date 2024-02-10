<hr>
<div class="divform ml-auto mr-auto center-form">
    <h2>Ajouter un commentaire</h2>
    <?php
    if (isset($errors) && !empty($errors)) {
        echo "<div class='alert alert-danger' style='width: 80%;margin: auto;'>";
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
        echo "</div>";
    }
    ?>
    <?php $this->includeComponent("form", $config);?>
</div>

<div class="modal" id="modal1" >
    <section>
        <header>
            <h1>Commentaire en attente de modération</h1>
        </header>
        <div class="modal_content ">
            <p>
                Votre commentaire est actuellement en cours de modération.<br>Vous serez averti(e) par e-mail lors de sa publication.
            </p>
        </div>
        <footer>
            <a href="/" class="button button-primary button-sm">
                Fermer
            </a>
        </footer>
    </section>
</div>