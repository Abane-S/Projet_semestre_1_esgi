<div class="divform ml-auto mr-auto center-form">
    <h2>Supprimer mon compte</h2><br>
    <div class='alert alert-danger m-auto mb-2' style='width: 80%'>Attention !<br>La suppression de votre compte sera définitive et irreversible.
    </div>
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

<div class="modal" id="modal5">
    <section>
        <header>
            <h1>Suppression du compte</h1>
        </header>
        <div class="modal_content">
            <p>
                Votre compte a été supprimé avec succès.
            </p>
        </div>
        <footer>
            <a href="/login" class="button button-primary">
                Fermer
            </a>
        </footer>
    </section>
</div>