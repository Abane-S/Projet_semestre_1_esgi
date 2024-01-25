<div class="div_input">
    <h2>Se connecter</h2>
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
    <a href="/forgot-password">Mot de passe oublié</a>
</div>