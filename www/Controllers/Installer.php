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
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Find the first <header> element and set its display property to none
                var firstHeader = document.querySelector('header');
                if (firstHeader) {
                    firstHeader.style.display = 'none';
                }
            });
        </script>

        <?php
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
        $subject = "Verify your account";
        $message = "
                    <h1>Thanks For Registration</h1>
                    <p>Click on the link below to verify your account</p>
                    <a href='http://".$_SERVER['HTTP_HOST']."/verify?token=".$token."'>Verify</a>
                ";
        $phpMailer->sendMail($user->getEmail(), $subject, $message);

        echo '<style>#modal4 { display: flex; }</style>';
    }

    public function installer(): void
    {
        if (file_exists('./.env')) {
            $view = new View("Error/page404", "front");
            exit;
        }
        if(isset($_SESSION['Account'])) {
            unset($_SESSION['Account']);
        }
        $form = new EnvInstaller();
            $view = new View("Installer/installer", "front");
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
                        "SITE_NAME=" . $site_name . "\n";
                    $handle = fopen("./.env", "w+");
                    fwrite($handle, $envdata);
                    if (file_exists("./.env")) {
                        $EnvDecomposer = new EnvDecomposer();
                        define("PDO_DSN", $EnvDecomposer->getPdoString());
                        define("TABLE_PREFIX", $EnvDecomposer->getTablePrefixString());
                        $DB = new DB();
                        $DB->CreateDB();
                        $this->CreateAdminAccount();
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
