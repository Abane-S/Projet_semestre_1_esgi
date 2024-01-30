<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des utilisateurs</h1>
    <button type="button" class="button button-primary button-md">Créer un utilisateur</button>
</div>
<div>
    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="mt-3">
            <?php if(!isset($user)): ?>
                <tr>
                    <td colspan=7 class="table_none text-center fs-2 p-3" >Aucun utilisateur pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php foreach($users as $user): ?>
                    <tr class="row">
                        <td ><?= $user['id'] ?></td>
                        <td><?= $user['Nom'] ?></td>
                        <td><?= $user['title'] ?></td>
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