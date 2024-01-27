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
        $phpMailer->sendMail($_POST['admin_email'], $_POST['admin_firstname'], $_POST['admin_lastname'], $token, "Verification");
        header("Location: " . '/email-verification');
        exit;
    }

    public function installer(): void
    {
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
                    $dbtableprefix =  $_POST['db_table_prefix'];

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


                    $envdata ="DB_SETTINGS=" . $db . "\n" . "TABLE_PREFIX=" . $dbtableprefix . "\n";
                    $handle = fopen("./.env", "w+");
                    fwrite($handle, $envdata);
                    if (file_exists("./.env")) {
                        $DB = new DB();
                        $DB->CreateDB();
                        $this->CreateAdminAccount();
                    }
                    else
                    {
                        $errors['user_email'] = "Une erreur s'est produite durant l'installation de votre environement.";
                        $view->assign('errors', $errors);
                        exit;
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
