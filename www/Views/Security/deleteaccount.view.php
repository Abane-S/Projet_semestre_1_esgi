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

<?php
if (isset($modal)) {
    $this->includeComponent("modal", $modal);
}
?>