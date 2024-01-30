<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des Commentaires</h1>
</div>
<div>
    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Contenu</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="mt-3">
            <?php if(!isset($user)): ?>
                <tr>
                    <td colspan=7 class="table_none text-center fs-2 p-3" >Aucun commentaire pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php foreach($comments as $comment): ?>
                    <tr class="row">
                        <td ><?= $comment['id'] ?></td>
                        <td><?= $comment['Content'] ?></td>
                        <td><?= $comment['status'] ?></td>
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