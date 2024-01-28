<div class="divform ml-auto mr-auto center-form" style="margin-bottom:3% !important;">
    <h2>Modifier les données du compte</h2>
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
<div style="margin-top:0% !important;" class="divform ml-auto mr-auto center-form">
    <h2>Option du compte</h2>
    <a href="\delete-account" class="button button-danger w-8">Supprimer mon compte</a><br>
</div>

<div class="modal" id="modal3">
    <section>
        <header>
            <h1>Compte modifié</h1>
        </header>
        <div class="modal_content">
            <p>
                Les données du compte ont bien été modifiées.<br>Vous pouvez désormais vous connecter avec vos nouvelles modifications.
            </p>
        </div>
        <footer>
            <a href="/logout" class="button button-primary">
                Fermer
            </a>
        </footer>
    </section>
</div>