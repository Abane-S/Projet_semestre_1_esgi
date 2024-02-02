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
                "class" => "form",
            ],
            "select" => [
                "db_engine" => [
                    "label" => "Système de gestion de base de données :",
                    "class" => "w-8 input-select",
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
                    "error" => "-Le format du mot de passe de la base de données est incorrect, minimum 8 caractères, maximum 45 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                    "required" => true
                ],
                "db_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Confirmation du mot de passe de la base de données :",
                    "placeholder" => "Confirmation du mot de passe de la base de données",
                    "confirm" => "db_password",
                    "error" => "-Vous avez insérer deux mots de passe de base de données différents",
                    "required" => true
                ],
                "db_table_prefix" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 7,
                    "label" => "Prefix de la table :",
                    "placeholder" => "esgi_",
                    "error" => "-Vous avez inséré un préfixe de table incorrect. Il doit comporter un minimum de 2 caractères et un maximum de 7 caractères, ne contenir que des lettres et obligatoirement inclure le caractère '_'",
                    "required" => true
                ],
                "admin_firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "min" => 2,
                    "max" => 45,
                    "label" => "Prénom :",
                    "error" => "-Votre prénom doit faire entre 2 et 45 caractères et ne doit contenir que des lettres",
                    "required" => true
                ],
                "admin_lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom de famille",
                    "min" => 2,
                    "max" => 45,
                    "label" => "Nom de famille :",
                    "error" => "-Votre nom de famille doit faire entre 2 et 45 caractères et ne doit contenir que des lettres",
                    "required" => true
                ],
                "admin_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "Adresse email :",
                    "placeholder" => "Votre email",
                    "error" => "-Le format de votre email est incorrect (exemple: test@gmail.com)",
                    "required" => true
                ],
                "admin_confirm_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "Confirmation adresse email :",
                    "placeholder" => "Confirmation de votre email",
                    "confirm" => "admin_email",
                    "error" => "-Vous avez insérer deux emails différents",
                    "required" => true
                ],
                "admin_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Mot de passe :",
                    "placeholder" => "Votre mot de passe",
                    "error" => "-Format incorrect, votre mot de passe du compte admin doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                    "required" => true
                ],
                "admin_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Confirmation du mot de passe :",
                    "placeholder" => "Confirmation de votre mot de passe",
                    "confirm" => "admin_password",
                    "error" => "-Vous avez insérer deux mots de passe admin différents",
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
