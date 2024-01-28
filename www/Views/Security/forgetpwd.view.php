<div class="divform ml-auto mr-auto center-form">
    <h2>Mot de passe oublié</h2>
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

<div class="modal" id="modal2">
    <section>
        <header>
            <h1>Email confirmation</h1>
        </header>
        <div class="modal_content">
            <p>
                Un mail de confirmation vous a été envoyé afin que vous puissiez changer votre mot de passe.
            </p>
        </div>
        <footer>
            <a href="/login" class="button button-primary">
                Fermer
            </a>
        </footer>
    </section>
</div>