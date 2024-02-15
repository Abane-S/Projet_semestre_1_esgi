<hr>
<div style="margin-bottom:0% !important;" class="divform ml-auto mr-auto center-form">
    <h2>Ajouter un commentaire</h2>
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
<hr>
<br>
<h2 class="center-form">Commentaire</h2>
<section style="margin-left: 30%">
    <?php if (empty($comments)): ?>
    <br>
        <p style="margin-left: 8%;
    justify-content: center;
    color: red;">
            Aucun commentaire est présent sur cette pages.
        </p>
    <br>
    <?php else: ?>
    <?php foreach ($comments as $comment): ?>
        <div>
            <br>
            <p><b><?php echo $comment['commenttitle']; ?></b></p>
            <p><?php echo $comment['comment']; ?></p>
            <p style="font-size: small;color: #343333;">publié par <?php echo $comment['fullname']; ?><br>le <?php echo date('d/m/Y H:i:s', strtotime($comment['created_at'])); ?></p>

        </div>
        <br>
    <?php endforeach; ?>
    <?php endif; ?>
</section>
<br>
<hr>
<br>