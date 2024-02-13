<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des utilisateurs</h1>
    <button type="button" class="button button-primary button-md" onclick="window.location.href='users/createUser'">Créer un utilisateur</button>
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
                <th>Email verifier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!isset($users) && empty($users)): ?>
                <tr>
                    <td colspan=7 class="table_none text-center fs-2 p-3" >Aucun utilisateur pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php foreach($users as $user): ?>
                    <tr class="row">
                        <td ><?= $user['id'] ?></td>
                        <td><?= $user['firstname'] ?></td>
                        <td><?= $user['lastname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td><?= $user['email_verified'] == 1 ? '<i class="ri-thumb-up-fill ml-3"></i>' : '<i class="ri-thumb-down-fill ml-3"></i>'  ?></td>
                        <td>
                            <a href="users/editUser/<?= $user['id'] ?>" class="button button-primary button-sm">Modifier</a>
                            <a href="users/deleteUser/<?= $user['id'] ?>" class="button button-danger button-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
        if (isset($modal)) {
            $this->includeComponent("modal", $modal);
        }
    ?>
</div>  