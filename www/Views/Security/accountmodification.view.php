<div class="divform ml-auto mr-auto center-form">
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

    <div class="col-md-6" style="margin: 3px 43px 30px 43px;
    padding: 20px;
    border: 3px solid;
    background-color: lightblue;">
        <span style="font-weight: bold;">Option du compte</span>
        <hr>
        <a href="\logout" class="btn btn-info btn-block w-7">Déconnexion</a><br>
        <a href="\" class="btn btn-danger mt-3 w-7"">Supprimer mon compte</a><br>
    </div>
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