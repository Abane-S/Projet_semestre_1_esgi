<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des commentaires</h1>
</div>
<div>
    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>ID Page</th>
                <th>Nom complet</th>
                <th>Titre</th>
                <th>Commentaire</th>
                <th>Valide</th>
                <th>Date de création</th>
            </tr>
        </thead>
        <tbody class="mt-3">
        <?php if (empty($comments)): ?>
                <tr>
                    <td colspan=7 class="table_none text-center fs-2 p-3" >Aucun commentaire pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php foreach($comments as $comment): ?>
                    <tr class="row">
                        <td ><?= $comment['id'] ?></td>
                        <td ><?= $comment['id_page'] ?></td>
                        <td><?= $comment['fullname'] ?></td>
                        <td><?= $comment['commenttitle'] ?></td>
                        <td><?= $comment['comment'] ?></td>
                        <td><?= $comment['valid'] ?></td>
                        <td><?= $comment['created_at'] ?></td>
                        <td>
                            <a href="/commentUpdate/<?= $comment['id'] ?>" class="button button-primary button-sm">Modifier</a>
                            <a href="/commentDelete/<?= $comment['id'] ?>" class="button button-danger button-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>  