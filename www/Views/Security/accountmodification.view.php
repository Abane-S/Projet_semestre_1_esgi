<div class="divform ml-auto mr-auto center-form" style="margin-bottom:3% !important;">
    <h2 class="fs-3 mb-5 mt-5">Modifier les données du compte</h2>
    <p class="ml-6" style="display: flex;
    text-align: justify;">Adresse email : <br>
        <?php echo $_SESSION['Account']['email'] ?></p><br>
    <?php
    if (isset($errors) && !empty($errors)) {
        echo "<div class='alert alert-danger m-auto mb-2'>";
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
        echo "</div>";
    }
    ?>
    <?php $this->includeComponent("form", $config);?>
    <a href="\delete-account" style="font-size:0.88rem!important;" class="button button-danger button-lg w-8 fs-4">Supprimer mon compte</a><br>

    <?php
    if (isset($modal)) {
        $this->includeComponent("modal", $modal);
    }
    ?>