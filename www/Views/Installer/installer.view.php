<div class="divform ml-auto mr-auto center-form">
    <h2>Installation - Base de données</h2><br><br>
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