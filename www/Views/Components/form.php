<form


    method="<?= $config["config"]["method"]??"GET" ?>"
    action="<?= $config["config"]["action"]??"" ?>"
    class="<?= $config["config"]["class"]??"" ?>"
    id="<?= $config["config"]["id"]??"" ?>">

    <?php
        // Définir les noms des champs que vous souhaitez récupérer
        $champs = ['user_firstname', 'user_lastname', 'user_email', 'user_confirm_email', 'user_password', 'user_confirm_password', 'csrf_token', 'db_name', 'db_host', 'db_port', 'db_username', 'db_port', "db_password", "db_confirm_password", "db_engine"];

        // Initialiser un tableau pour stocker les valeurs
        $valeurs = [];

        // Boucle pour récupérer les valeurs depuis $_POST ou utiliser une chaîne vide si elles n'existent pas
        foreach ($champs as $champ) {
            $valeurs[$champ] = $_POST[$champ] ?? '';
        }
    ?>

    <div class="div_input">


        <?php if (isset($config["select"]) && is_array($config["select"])): ?>
            <?php foreach ($config["select"] as $name => $configSelect): ?>

                <?php if ($configSelect["label"]): ?>
                    <label for="<?= $name ?>"><?= $configSelect["label"] ?? "" ?></label>
                <?php endif; ?>

                <select
                        name="<?= $name ?>"
                        id="<?= $name ?>"
                        class="<?= $configSelect["class"] ?? "" ?>"
                    <?= (!empty($configSelect["required"])) ? "required" : "" ?>
                >
                    <?php foreach ($configSelect["options"] as $value => $label): ?>
                        <option value="<?= $value ?>" <?= (isset($valeurs[$name]) && $valeurs[$name] == $value) ? "selected" : "" ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <br>

            <?php endforeach; ?>
        <?php endif; ?>


    <?php foreach ($config["inputs"] as $name => $configInput): ?>

        <?php if ($configInput["label"]): ?>
            <label for="<?= $name ?>"><?= $configInput["label"] ?? "" ?></label>
        <?php endif; ?>

        <input
                name="<?= $name ?>"
                type="<?= $configInput["type"] ?? "text" ?>"
                id="<?= $configInput["id"] ?? "" ?>"
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

    <?php endforeach; ?>

    <input type="submit" name="submit" value="<?= $config["config"]["submit"]??"Envoyer" ?>">
    </div>
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