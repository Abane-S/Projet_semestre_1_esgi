<div class="div_input">
    <h2>Modifier les données du compte</h2>
    <?php
var_dump($_SESSION['Account']);
    if (isset($errors) && !empty($errors)) {
        echo "<div class='alert alert-danger' style='width: 80%;margin: auto;'>";
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
        echo "</div>";
    }
    ?>
    <?php $this->includeComponent("form", $config);?>
    <div>
    <a href="\soft-delete" class="btn btn-danger">Supprimer mon compte (Soft DELETE)</a>
    <a href="\hard-delete" class="btn btn-danger">Supprimer mon compte (Hard DELETE)</a>
    </div>
</div>