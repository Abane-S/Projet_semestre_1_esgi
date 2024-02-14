<h1 class="fs-4 mb-3">Creation de l'Article</h1>
<?php 
  $this->includeComponent("form", $config); ?>

<?php
    if (isset($modal)) {
        $this->includeComponent("modal", $modal);
    }
?>
