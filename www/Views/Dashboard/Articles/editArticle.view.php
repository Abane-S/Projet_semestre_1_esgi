<h1 class="fs-4 mb-3">Editer votre Article</h1>

<?php $this->includeComponent("form", $config); ?>

<?php
    if (isset($modal)) {
        $this->includeComponent("modal", $modal);
    }
?>