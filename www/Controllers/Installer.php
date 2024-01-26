<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\EnvInstaller;
use App\Forms\AdminInstaller;

class Installer
{

    public function installAdminAccount(): void
    {
        if(file_exists('./.env')){
            $EnvDecomposer = new EnvDecomposer();
            $InstallationStep = $EnvDecomposer->getInstallerStep();
            if($InstallationStep == "2/3")
            {
                header("Location: /installer3-3");
                exit;
            }
        }
            $form = new AdminInstaller();
            $view = new View("Installer/installer2", "front");
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidInstall()){
                echo "OK";
            }
            else
            {
                $view->assign('errors', $form->listOfErrors);
            }
    }

    public function installBdd(): void
    {
        if(file_exists('./.env')){
            $EnvDecomposer = new EnvDecomposer();
            $InstallationStep = $EnvDecomposer->getInstallerStep();
            if($InstallationStep == "1/3")
            {
                header("Location: /installer2-3");
                exit;
            }
            if($InstallationStep == "2/3")
            {
                header("Location: /installer3-3");
                exit;
            }
        }

            $form = new EnvInstaller();
            $view = new View("Installer/installer1", "front");
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidInstall()){
                try {

                    $dbengine = $_POST['db_engine'];
                    $dbhost = $_POST['db_host'];
                    $dbname = $_POST['db_name'];
                    $dbuser = $_POST['db_username'];
                    $dbpassword = $_POST['db_password'];
                    $dbport = $_POST['db_port'];

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


                    $envdata ="DB_SETTINGS=" . $db . "\n" ."INSTALL=1/3" . "\n";
                    $handle = fopen("./.env", "w+");
                    fwrite($handle, $envdata);
                    if (file_exists("./.env")) {
                        //Creer BDD :
                        header("Location: /installer2-3");
                        exit;
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
