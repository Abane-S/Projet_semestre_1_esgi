<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\EnvInstaller;
use App\Forms\AdminInstaller;

class Installer
{

    public function installNext(): void
    {
        if (file_exists("./.env2"))
        {
            header("Location: /installer");
            exit;
        }
        else
        {
            $form = new AdminInstaller();
            $view = new View("Installer/installadmin", "front");
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidInstall()){
                echo "OK";
            }
            else
            {
                $view->assign('errors', $form->listOfErrors);
            }
        }
    }

    public function install(): void
    {
        if (file_exists("./.env"))
        {
            header("Location: /");
            exit;
        }
        else
        {
            $form = new EnvInstaller();
            $view = new View("Installer/install", "front");
            $view->assign('config', $form->getConfig());
            if ($form->isSubmit() && $form->isValidInstall()){
                try {
                    $dbhost = $_POST['db_host'];
                    $dbname = $_POST['db_name'];
                    $dbuser = $_POST['db_username'];
                    $dbpassword = $_POST['db_password'];
                    $dbport = $_POST['db_port'];

                    $this->pdo = new \PDO("pgsql:host=$dbhost;port=$dbport;dbname=$dbname;user=$dbuser;password=$dbpassword");
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
}
