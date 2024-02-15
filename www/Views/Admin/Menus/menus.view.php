<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des menus</h1>
    <button type="button" class="button button-primary button-md">Créer un menu</button>
</div>
<div>
    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Parent ID</th>
                <th>Titre</th>
                <th>Visible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="mt-3">
            <?php if(!isset($user)): ?>
                <tr>
                    <td colspan=7 class="table_none text-center fs-2 p-3" >Aucun menu pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php foreach($menus as $menu): ?>
                    <tr class="row">
                        <td ><?= $menu['id'] ?></td>
                        <td><?= $menu['Nom'] ?></td>
                        <td><?= $menu['title'] ?></td>
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