<form


    method="<?= $config["config"]["method"]??"GET" ?>"
    action="<?= $config["config"]["action"]??"" ?>"
    class="<?= $config["config"]["class"]??"" ?>"
    id="<?= $config["config"]["id"]??"" ?>">

    <?php
        // Définir les noms des champs que vous souhaitez récupérer
        $champs = ['user_firstname', 'user_lastname', 'user_email', 'user_confirm_email', 'user_password', 'user_confirm_password', 'csrf_token'];

        // Initialiser un tableau pour stocker les valeurs
        $valeurs = [];

        // Boucle pour récupérer les valeurs depuis $_POST ou utiliser une chaîne vide si elles n'existent pas
        foreach ($champs as $champ) {
            $valeurs[$champ] = $_POST[$champ] ?? '';
        }
    ?>

    <div class="div_input">
    <?php foreach ($config["inputs"] as $name => $configInput): ?>

        <input
                name="<?= $name ?>"
                type="<?= $configInput["type"] ?? "text" ?>"
                id="<?= $configInput["id"] ?? "" ?>"
                class="<?= $configInput["class"] ?? "" ?>"
                placeholder="<?= $configInput["placeholder"] ?? "" ?>"
                value="<?= ($name == "csrf_token") ? GenerateCSRFToken() : $valeurs[$name] ?>"
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