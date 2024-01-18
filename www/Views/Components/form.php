<form


    method="<?= $config["config"]["method"]??"GET" ?>"
    action="<?= $config["config"]["action"]??"" ?>"
    class="<?= $config["config"]["class"]??"" ?>"
    id="<?= $config["config"]["id"]??"" ?>">

    <?php if(!empty($this->data['errors'])) :?>
    <div style="background-color: red">
        <?php foreach ($this->data['errors'] as $error):?>
            <li><?= $error ?></li>
        <?php endforeach;?>
    </div>
    <?php endif;?>


    <?php
        // Définir les noms des champs que vous souhaitez récupérer
        $champs = ['user_firstname', 'user_lastname', 'user_email', 'user_confirm_email', 'user_password', 'user_confirm_password'];

        // Initialiser un tableau pour stocker les valeurs
        $valeurs = [];

        // Boucle pour récupérer les valeurs depuis $_POST ou utiliser une chaîne vide si elles n'existent pas
        foreach ($champs as $champ) {
            $valeurs[$champ] = $_POST[$champ] ?? '';
        }
    ?>

    <?php foreach ($config["inputs"] as $name=>$configInput):?>

        <input
            name="<?= $name?>"
            type="<?= $configInput["type"]??"text"?>"
            id="<?= $configInput["id"]??""?>"
            class="<?= $configInput["class"]??""?>"
            placeholder="<?= $configInput["placeholder"]??""?>"
            value="<?= $valeurs[$name] ?>"
            <?= (!empty($configInput["required"]))?"required":""?>
        ><br>

    <?php endforeach;?>

    <input type="submit" name="submit" value="<?= $config["config"]["submit"]??"Envoyer" ?>">
</form>