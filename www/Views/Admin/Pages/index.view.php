<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des pages</h1>
    <button type="button" id="pageCreation" onclick="window.location.href='pages/create'"  class="button button-primary button-md">Créer une page</button>
</div>
<div>
    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody >
            <?php if(!isset($pages)): ?>
                <tr>
                    <td colspan=3 class="table_none text-center fs-2 p-3">Aucune page pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php foreach($pages as $page): ?>
                    <tr>
                        <td ><?= $page['id'] ?></td>
                        <td><?= $page['title'] ?></td>
                        <td>
                            <a href="#" class="button button-primary button-sm">Modifier</a>
                            <a href="#" class="button button-danger button-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>  



