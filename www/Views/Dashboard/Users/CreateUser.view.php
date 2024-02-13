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
</div>
