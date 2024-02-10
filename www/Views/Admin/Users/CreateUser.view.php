<h1 class="fs-4">Créer un utilisateur</h1>
<div class="divform ml-auto mr-auto center-form mt-4">
    <?php

        if (isset($errors) && !empty($errors)) {
            echo "<div class='alert alert-danger m-auto' style='width: 80%'>";
            foreach ($errors as $error) {
                echo "<p>" . $error . "</p>";
            }
            echo "</div>";
        }
    ?>
    <?php $this->includeComponent("form", $form);?>
    <?php
        if (isset($modal)) {
            $this->includeComponent("modal", $modal);
        }
    ?>

    <!-- <div class="modal" id="modal1" >
        <section>
            <header>
                <h1>Email confirmation</h1>
            </header>
            <div class="modal_content ">
                <p>
                    Félicitations ! L'utilisateur a été enregistré avec succès. Vous pouvez maintenant accéder à son profil et gérer ses informations. <br>
                    Merci !
                </p>
            </div>
            <footer>
                <a href="/dashboard/users" class="button button-primary button-sm">
                    Fermer
                </a>
            </footer>
        </section>
    </div> -->
</div>
