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
                <th>Description</th>
                <th>Miniature</th>
                <th>Commentaire activer</th>
                <th>Contenue</th>
                <th>Date de création</th>
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
                    <tr>
                        <td ><?= $page['id'] ?></td>
                        <td><?= $page['title'] ?></td>
                        <td><?= $page['meta_description'] ?></td>
                        <td><?= $page['miniature'] ?></td>
                        <td><?= $page['comments'] == 1 ? '<i class="ri-checkbox-line ml-3"></i>' : '<i class="ri-checkbox-blank-line ml-3"></i>'  ?></td>
                        <td><?= $page['content'] ?></td>
                        <td><?= $page['created_at'] ?></td>
                        <td>
                            <a href="/editPage/<?= $page['id'] ?>" class="button button-primary button-sm">Modifier</a>
                            <br>
                            <a href="/deletePage/<?= $page['id'] ?>" class="button button-danger button-sm">Supprimer</a>
                            <br>
                            <a href="/page/<?= $page['id'] ?>" class="button button-succes button-sm">Afficher</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>  



