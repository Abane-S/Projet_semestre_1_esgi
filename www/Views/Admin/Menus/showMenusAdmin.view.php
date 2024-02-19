 <div class="d-flex justify-between">
        <h1 class="fs-4">Liste des menus</h1>
     <button type="button" id="pageCreation" onclick="window.location.href='menus/create'"  class="button button-primary button-md">Créer un menu</button>
    </div>
    <div>
        <table class="mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titre du menu</th>
                <th>Icon du menu</th>
                <th>Titre du blog</th>
                <th>Description</th>
                <th>Miniature</th>
                <th>Contenue</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody >
            <?php if (empty($menus)):?>
                <tr>
                    <td colspan=3 class="table_none text-center fs-2 p-3">Aucune page pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php  foreach($menus as $menu): ?>
                    <tr>
                        <td ><?= $menu['id'] ?></td>
                        <td ><?= $menu['title_menu'] ?></td>
                        <td><?= "<i class='{$menu['icon_menu']}'></i>"; ?></td>
                        <td><?= $menu['title'] ?></td>
                        <td><?= $menu['meta_description'] ?></td>
                        <td><?= $menu['miniature'] ?></td>
                        <td><?= $menu['content'] ?></td>
                        <td><?= $menu['created_at'] ?></td>
                        <td>
                            <a href="/editMenu/<?= $menu['id'] ?>" class="button button-primary button-sm">Modifier</a>
                            <br>
                            <a href="/deleteMenu/<?= $menu['id'] ?>" class="button button-danger button-sm">Supprimer</a>
                            <br>
                            <a href="/menu/<?= $menu['id'] ?>" class="button button-succes button-sm">Afficher</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>  



