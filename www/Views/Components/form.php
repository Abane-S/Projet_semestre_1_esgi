<form


    method="<?= $config["config"]["method"]??"GET" ?>"
    action="<?= $config["config"]["action"]??"" ?>"
    class="<?= $config["config"]["class"]??"" ?>"
    enctype="<?= $config["config"]["enctype"]??"" ?>"
    <?php if (!empty($config["config"]["id"])): ?>
        id="<?= $config["config"]["id"] ?>"
    <?php endif; ?> >

    <?php
        // Définir les noms des champs que vous souhaitez récupérer
        $champs = ['user_firstname', 'user_lastname', 'user_email', 'user_confirm_email', 'user_password', 'user_confirm_password', 'csrf_token', 'db_name', 'db_host', 'db_port', 'db_username', 'db_port', "db_password", "db_confirm_password", "db_engine", "db_table_prefix", 'admin_firstname', 'admin_lastname', 'admin_email', 'admin_confirm_email', 'admin_password', 'admin_confirm_password', 'account_delete', 'site_name', 'site_img', 'smtp_name', 'smtp_username', 'smtp_name', 'smtp_confirm_password', 'smtp_password', 'smtp_confirm_email', 'smtp_email', 'smtp_port', 'smtp_host', 'comment_title', 'comment', 'contact_subject', 'contact_message', 'comment_valid', 'page_file', 'page_meta_description', 'page_title', 'page_comment', 'page_content'];

        // Initialiser un tableau pour stocker les valeurs
        $valeurs = [];

        // Boucle pour récupérer les valeurs depuis $_POST ou utiliser une chaîne vide si elles n'existent pas
        foreach ($champs as $champ) {
            $valeurs[$champ] = $_POST[$champ] ?? '';
        }
    ?>



        <?php if (isset($config["select"]) && is_array($config["select"])): ?>
            <?php foreach ($config["select"] as $name => $configSelect): ?>

                <?php if ($configSelect["label"]): ?>
                    <label for="<?= $name ?>"><?= $configSelect["label"] ?? "" ?></label>
                <?php endif; ?>

                <select
                        name="<?= $name ?>"
                        <?php if (!empty($configSelect["id"])): ?>
                            id="<?= $configSelect["id"] ?>"
                        <?php endif; ?>
                        class="<?= $configSelect["class"] ?? "" ?>">
                    <?= (!empty($configSelect["required"])) ? "required" : "" ?>
                
                    <?php foreach ($configSelect["options"] as $value => $label): ?>
                        <option value="<?= $value ?>" <?= (isset($valeurs[$name]) && $valeurs[$name] == $value) ? "selected" : "" ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <br><br>

            <?php endforeach; ?>
        <?php endif; ?>


        <?php if (isset($config["inputs"])): ?>
    <?php foreach ($config["inputs"] as $name => $configInput): ?>
        <?php // if ($configInput["label"]): ?>
            <label for="<?= $name ?>"><?= $configInput["label"] ?? "" ?></label>
        <?php // endif; ?>

        <input
                name="<?= $name ?>"
                type="<?= $configInput["type"] ?? "text" ?>"
                <?php if (!empty($configInput["id"])): ?>
                    id="<?= $configInput["id"] ?>"
                <?php endif; ?>
                class="<?= $configInput["class"] ?? "" ?>"
                placeholder="<?= $configInput["placeholder"] ?? "" ?>"
            <?php
            if ($name == "csrf_token") {
                echo 'value="' . GenerateCSRFToken() . '"';
            }
            if ($name != "csrf_token" && isset($configInput["value"]) && $configInput["value"] != "")
            {
                echo 'value="' . $configInput["value"] . '"';
            }
            if ($name != "csrf_token" && !isset($configInput["value"]))
            {
                echo 'value="' . $valeurs[$name] . '"';
            }
            ?>
            <?= (!empty($configInput["required"])) ? "required" : "" ?>
        >

        <?php if ($name !== "csrf_token"): ?>
            <br>
        <?php endif; ?>

            <?php if ($name == "db_table_prefix"): ?>
                <br>
                <h2> Installation - Compte Admin</h2>
        <br>
            <?php endif; ?>

                <?php if ($name == "admin_confirm_password"): ?>
                    <br>
                    <h2> Installation - Serveur SMTP</h2>
                    <br>
                <?php endif; ?>

                <?php if ($name == "smtp_name"): ?>
                    <br>
                    <h2> Installation - Site</h2>
                    <br>
                <?php endif; ?>


    <?php endforeach; ?>
        <?php endif; ?>

    <?php if (isset($config["textarea"]) && is_array($config["textarea"])): ?>
        <?php foreach ($config["textarea"] as $name => $configSelect): ?>

            <?php if ($configSelect["label"]): ?>
                <label for="<?= $name ?>"><?= $configSelect["label"] ?? "" ?></label>
            <?php endif; ?>

            <textarea
                    name="<?= $name ?>"
                <?php if (!empty($configSelect["id"])): ?>
                    id="<?= $configSelect["id"] ?>"
                <?php endif; ?>
                    class="<?= $configSelect["class"] ?? "" ?>"

                ?><?= $configSelect["value"] ?? "" ?>

            </textarea>

            <br><br>

        <?php endforeach; ?>
    <?php endif; ?>

    <input type="submit" name="submit" value="<?= $config["config"]["submit"]??"Envoyer" ?>">
</form>

<?php
// Function to generate CSRF token
function GenerateCSRFToken()
{
    if (!isset($_SESSION['csrf_token']) || empty($_SESSION['csrf_token'])) {
        // Generate a random string for the CSRF token
        $token = bin2hex(random_bytes(32));

        // Store the token in the session for verification
        $_SESSION['csrf_token'] = $token;
    } else {
        // Retrieve the existing CSRF token from the session
        $token = $_SESSION['csrf_token'];
    }

    return $token;
}