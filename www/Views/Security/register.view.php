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

<?php
if (isset($modal)) {
    $this->includeComponent("modal", $modal);
}
?>