<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\EnvInstaller;
use App\Forms\AdminInstaller;
use App\Models\PhpMailor;
use App\Models\User;
use App\Core\DB;

class Installer
{

    public function __construct()
    {
    }

    private function CreateAdminAccount() :void
    {
        $user = new User();
        $token = bin2hex(random_bytes(32));
        $user->setVericationToken($token);
        $user->setFirstname($_POST['admin_firstname']);
        $user->setLastname($_POST['admin_lastname']);
        $user->setEmail($_POST['admin_email']);
        $user->setPassword($_POST['admin_password']);
        $user->setRole("admin");
        $user->save();

        $phpMailer = new PhpMailor();
        $subject = "Veuillez vérifier votre compte";
        $message = "
                    <h1>Merci de votre inscription</h1>
                    <p>Merci de cliquer sur le lien ci-dessous pour vérifier votre compte</p>
                    <a href='".SITE_URL."/verify?token=".$token."'>Verify</a>
                ";
        $phpMailer->sendMail($user->getEmail(), $subject, $message);
    }

    public function installer(): void
    {

        if(isset($_SESSION['Account'])) {
            unset($_SESSION['Account']);
        }
        $form = new EnvInstaller();
            $view = new View("Installer/installer", "front");
            $view->assign("showNavbar", "false");

            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidInstall()){
                try {

                    $dbengine = $_POST['db_engine'];
                    $dbhost = $_POST['db_host'];
                    $dbname = $_POST['db_name'];
                    $dbuser = $_POST['db_username'];
                    $dbpassword = $_POST['db_password'];
                    $dbport = $_POST['db_port'];
                    $dbtableprefix = $_POST['db_table_prefix'];
                    $smtp_host = $_POST['smtp_host'];
                    $smtp_port = $_POST['smtp_port'];
                    $smtp_email = $_POST['smtp_email'];
                    $smtp_password = $_POST['smtp_password'];
                    $smtp_username = $_POST['smtp_username'];
                    $smtp_name = $_POST['smtp_name'];
                    $site_name = $_POST['site_name'];

// Chemin temporaire du fichier uploadé
                    $chemin_temporaire = $_FILES['site_img']['tmp_name'];

// Vérifier si le fichier uploadé est une image
                    if (getimagesize($chemin_temporaire) !== false) {
                        // Obtenir l'extension du fichier
                        $extension = pathinfo($_FILES['site_img']['name'], PATHINFO_EXTENSION);

                        // Vérifier si l'extension est l'une des extensions d'image autorisées
                        if (in_array($extension, array('jpeg', 'jpg', 'png', 'gif'))) {
                            // Lire le contenu du fichier dans une variable
                            $contenu_image = file_get_contents($chemin_temporaire);

                            // Obtenir le type MIME de l'image
                            $type_mime = mime_content_type($chemin_temporaire);

                            // Convertir le contenu de l'image en une chaîne base64
                            $image_base64 = base64_encode($contenu_image);

                            // Créer l'URI de données pour l'image
                            $image_data_uri = 'data:' . $type_mime . ';base64,' . $image_base64;
                            $site_logo = $image_data_uri;
                        } else {
                            $view->assign("errors", ["-Format de l'image incorrect<br>(.PNG ou .JPEG ou .JPG ou .GIF)"]);
                            exit;
                        }
                    }
                    else {
                        $view->assign("errors", ["-Format de l'image incorrect<br>(.PNG ou .JPEG ou .JPG ou .GIF)"]);
                        exit;
                    }


                    if ($dbengine == "pgsql") {
                        $db = "pgsql:host=$dbhost;port=$dbport;dbname=$dbname;user=$dbuser;password=$dbpassword";
                        $this->pdo = new \PDO($db);
                    }
                    if ($dbengine == "mysql") {
                        $db = "mysql:host=$dbhost;port=$dbport;dbname=$dbname;user=$dbuser;password=$dbpassword";
                        $this->pdo = new \PDO($db);
                    }
                    if ($dbengine == "sqlsrv") {
                        $db = "sqlsrv:Server=$dbhost,$dbport;Database=$dbname;user=$dbuser;password=$dbpassword";
                        $this->pdo = new \PDO($db);
                    }
                    if ($dbengine == "oracle") {
                        $db = "oci:dbname=//$dbhost:$dbport/$dbname/$dbuser/$dbpassword";
                        $this->pdo = new \PDO($db);
                    }
                    if ($dbengine == "cubrid") {
                        $db = "cubrid:host=$dbhost;port=$dbport;dbname=$dbname;user=$dbuser;password=$dbpassword";
                        $this->pdo = new \PDO($db);
                    }
                    if ($dbengine == "odbc") {
                        $db = "odbc:Driver={DriverName};Server=$dbhost;Database=$dbname;user=$dbuser;password=$dbpassword";
                        $this->pdo = new \PDO($db);
                    }
                    if ($dbengine == "firebird") {
                        $db = "firebird:host=$dbhost;dbname=$dbname;user=$dbuser;password=$dbpassword";
                        $this->pdo = new \PDO($db);
                    }

                    try
                    {
                        define("SMTP_HOST", $smtp_host);
                        define("SMTP_USERNAME", $smtp_username);
                        define("SMTP_PASSWORD", $smtp_password);
                        define("SMTP_PORT", $smtp_port);
                        define("SMTP_EMAIL", $smtp_email);
                        define("SMTP_NAME", $smtp_name);
                        $phpMailer = new PhpMailor();
                        $subject = "Test de connexion au serveur SMTP";
                        $message = "Ceci est un test envoyer depuis le site : " . $smtp_name;
                        $phpMailer->sendMail($smtp_email, $subject, $message);

                    $envdata =
                        "DB_SETTINGS=" . $db . "\n" .
                        "TABLE_PREFIX=" . $dbtableprefix . "\n" .
                        "SMTP_HOST=" . $smtp_host . "\n" .
                        "SMTP_USERNAME=" . $smtp_username . "\n" .
                        "SMTP_PASSWORD=" . $smtp_password . "\n" .
                        "SMTP_PORT=" . $smtp_port . "\n" .
                        "SMTP_EMAIL=" . $smtp_email . "\n" .
                        "SMTP_NAME=" . $smtp_name . "\n" .
                        "SITE_NAME=" . $site_name . "\n".
                        "SITE_LOGO=" . $site_logo . "\n";
                    $handle = fopen("./.env", "w+");
                    fwrite($handle, $envdata);
                    if (file_exists("./.env")) {
                        $URL_SITE = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
                        define("SITE_URL", $URL_SITE);
                        $EnvDecomposer = new EnvDecomposer();
                        define("PDO_DSN", $EnvDecomposer->getPdoString());
                        define("TABLE_PREFIX", $EnvDecomposer->getTablePrefixString());
                        $DB = new DB();
                        $DB->CreateDB();
                        $this->CreateAdminAccount();
                        $modal = [
                            "title" => "Email confirmation",
                            "content" => "Un mail de confirmation vous a été envoyé.<br>Merci de confirmer votre adresse e-mail afin de pouvoir vous connecter.",
                            "redirect" => "/login"
                        ];
                        $view->assign("modal", $modal);
                    } else {
                        $errors['user_email'] = "Une erreur s'est produite durant l'installation de votre environement.";
                        $view->assign('errors', $errors);
                        exit;
                    }
                    }
                    catch (Exception $e) {
                        $view->assign("errors", ["Un problème est survenu lors de la connexion au serveur SMTP : <br>" . $e->getMessage()]);
                    }

                } catch (\PDOException $e) {
                    $view->assign("errors", ["Un problème est survenu lors de la connexion à la base de données : <br>" . $e->getMessage()]);
                }
            }
            else
            {
                $view->assign('errors', $form->listOfErrors);
            }
    }
}
