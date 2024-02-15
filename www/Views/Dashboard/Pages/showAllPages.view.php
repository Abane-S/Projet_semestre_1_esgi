<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des Pages</h1>
    <button type="button" id="pageCreation" onclick="window.location.href='pages/createPage'"  class="button button-primary button-md">Créer une page</button>
</div>

<?php //  $this->includeComponent(table, $config); ?>
<div>
    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Titre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody >
            <?php if (empty($pages)):?>
                <tr>
                    <td colspan=3 class="table_none text-center fs-2 p-3">Aucune page pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php  foreach($pages as $page): ?>
                    <tr class="row">
                        <td ><?= $page['id'] ?></td>
                        <td><?= $page['title'] ?></td>
                        <td><?= $page['titre'] ?></td>
                        <td>
                            <a href="pages/editPage/<?= $page['id'] ?>" class="button button-primary button-sm">Modifier</a>
                            <a href="pages/deletePage/<?= $page['id'] ?>" class="button button-danger button-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>  

<?php 
    if (isset($modal)) {
        $this->includeComponent("modal", $modal);
    }
?>


