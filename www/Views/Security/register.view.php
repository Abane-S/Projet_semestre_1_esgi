<div class="divform ml-auto mr-auto center-form mt-4">
    <h2 class="fs-4 ">S' inscrire</h2>
    <?php

        if (isset($errors) && !empty($errors)) {
            echo "<div class='alert alert-danger m-auto' style='width: 80%'>";
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
            <h1>Email confirmation</h1>
        </header>
        <div class="modal_content ">
            <p>
                Un mail de confirmation vous a été envoyé.<br>Merci de confirmer votre adresse e-mail afin de pouvoir vous connecter.
            </p>
        </div>
        <footer>
            <a href="/login" class="button button-primary button-sm">
                Fermer
            </a>
        </footer>
    </section>
</div>