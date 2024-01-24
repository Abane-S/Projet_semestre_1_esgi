<div class="div_input">
    <h2>S' inscrire</h2>
    <?php
        if (isset($errors)) {
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