<?php

namespace App\forms;
use App\Core\Verificator;


class EnvInstaller extends Verificator
{

    protected $method = "POST";

    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Valider",
            ],
            "select" => [
                "db_engine" => [
                    "label" => "Système de gestion de base de données :",
                    "options" => [
                        "pgsql" => "PostgreSQL",
                        "mysql" => "MySQL",
                        "sqlsrv" => "SQL Server",
                        "oracle" => "Oracle",
                        "cubrid" => "CUBRID",
                        "odbc" => "ODBC",
                        "firebird" => "Firebird"
                    ],
                    "error" => "-Veuillez sélectionner un type de base de données",
                    "required" => true
                ]
            ],
            "inputs" => [
                "db_name" =>[
                    "type" => "text",
                    "label" => "Nom de la base de données : ",
                    "min" => 1,
                    "max" => 64,
                    "placeholder" => "Portfolio_DB",
                    "error" => "-Le nom d'utilisateur de la base de données est incorrect, longeur entre 1 et 64 caractères, et ne peut contenir que des lettres (majuscules et minuscules), des chiffres et des caractères de soulignement",
                    "required" => true
                ],
                "db_host" =>[
                    "type" => "text",
                    "label" => "Hôte de la base de données : ",
                    "min" => 1,
                    "max" => 64,
                    "placeholder" => "database",
                    "error" => "-L'hôte de la base de données est incorrect, longeur entre 1 et 64 caractères, et ne peut contenir que des lettres (majuscules et minuscules), des chiffres et des caractères de soulignement",
                    "required" => true
                ],
                "db_port" =>[
                    "type" => "text",
                    "label" => "Port de la base de données : ",
                    "min" => 1,
                    "placeholder" => "5432",
                    "error" => "-Le port de la base de données est incorrect<br>(il doit être compris entre 0 et 65535)",
                    "required" => true
                ],
                "db_username" =>[
                    "type" => "text",
                    "label" => "Nom d'utilisateur de la base de données :",
                    "min" => 3,
                    "max" => 20,
                    "placeholder" => "Portfolio_USER",
                    "error" => "-Le nom d'utilisateur de la base de données est incorrect, longeur entre 3 et 20 caractères, et ne peut contenir que des lettres (majuscules et minuscules), des chiffres et des caractères de soulignement",
                    "required" => true
                ],
                "db_password" => [
                    "type" => "password",
                    "label" => "Mot de passe de la base de données :",
                    "min" => 8,
                    "max" => 45,
                    "placeholder" => "Portfolio_PASS123@",
                    "error" => "-Format du mot de passe incorrect, minimum 8 caractères, maximum 45 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                    "required" => true
                ],
                "db_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Confirmation du mot de passe de la base de données :",
                    "placeholder" => "Confirmation du mot de passe de la base de données",
                    "confirm" => "db_password",
                    "error" => "-Vous avez insérer deux mots de passe différents",
                    "required" => true
                ],
                "csrf_token" => [
                    "type" => "hidden",
                    "placeholder" => "",
                    "label" => "",
                    "error" => "",
                    "required" => true
                ],
            ]
        ];

        return $this->config;
    }
}
