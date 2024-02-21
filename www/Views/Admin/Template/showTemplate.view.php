<div class="d-flex justify-between">
    <h1 class="fs-4">Liste des templates</h1>
    <button type="button" id="pageCreation" onclick="window.location.href='/template/create'"  class="button button-primary button-md">Créer un template</button>
</div>
<div>
    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du template</th>
                <th>Police</th>
                <th>Taille police</th>
                <th>Couleur background</th>
                <th>Couleur textes</th>
                <th>Couleur navbar</th>
                <th>Couleur menus navbar</th>
                <th>Actif</th>
                <th>Defaut</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody >
            <?php if (empty($templates)):?>
                <tr>
                    <td colspan=3 class="table_none text-center fs-2 p-3">Aucun template pour le moment</td>
                </tr>
            <?php else:  ?>
                <?php  foreach($templates as $template): ?>
                    <tr>
                        <td ><?= $template['id'] ?></td>
                        <td><?= $template['name'] ?></td>
                        <td><?= $template['police_name'] ?></td>
                        <td><?= $template['police_size'] . "px" ?></td>
                        <td><?= $template['background_color'] ?></td>
                        <td><?= $template['text_color'] ?></td>
                        <td><?= $template['navbar_color'] ?></td>
                        <td><?= $template['menu_color'] ?></td>
                        <td><?= $template['active'] == 1 ? '<i class="ri-checkbox-line ml-3"></i>' : '<i class="ri-checkbox-blank-line ml-3"></i>'  ?></td>
                        <td><?= $template['default_tpl'] == 1 ? '<i class="ri-checkbox-line ml-3"></i>' : '<i class="ri-checkbox-blank-line ml-3"></i>'  ?></td>
                        <?php if ($template['default_tpl'] == 1) { ?>
                            <td><?= $template['created_at'] ?> (Installation)</td>
                        <?php } else { ?>
                            <td><?= $template['created_at'] ?></td>
                        <?php } ?>
                        <td>
                            <a href="/editTemplate/<?= $template['id'] ?>" class="button button-primary button-sm">Modifier</a>
                            <br>
                            <a href="/deleteTemplate/<?= $template['id'] ?>" class="button button-danger button-sm">Supprimer</a>
                            <br>
                            <a href="/setTemplate/<?= $template['id'] ?>" class="button button-succes button-sm">Appliquer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>  



