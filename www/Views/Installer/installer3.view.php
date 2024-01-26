<div class="div_input">
    <h2>Installation (3/3)</h2>
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