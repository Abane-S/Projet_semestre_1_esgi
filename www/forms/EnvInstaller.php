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
                    "label" => "Prefix des table :",
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
                "smtp_host" =>[
                    "type" => "text",
                    "label" => "Hôte SMTP : ",
                    "min" => 2,
                    "max" => 25,
                    "placeholder" => "mailhog-server",
                    "error" => "-L'hôte SMTP est incorrect, longeur entre 2 et 25 caractères, et ne peut contenir que des lettres (majuscules et minuscules), des chiffres et des caractères spéciaux tel que ('.' '-')",
                    "required" => true
                ],
                "smtp_port" =>[
                    "type" => "text",
                    "label" => "Port SMTP : ",
                    "min" => 1,
                    "placeholder" => "1025",
                    "error" => "-Le port SMTP est incorrect<br>(il doit être compris entre 0 et 65535)",
                    "required" => true
                ],
                "smtp_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "Adresse email SMTP :",
                    "placeholder" => "Votre email",
                    "error" => "-Le format de votre email SMTP est incorrect (exemple: test@gmail.com)",
                    "required" => true
                ],
                "smtp_confirm_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "Confirmation adresse email SMTP :",
                    "placeholder" => "Confirmation de votre email",
                    "confirm" => "smtp_email",
                    "error" => "-Vous avez insérer deux emails SMTP différents",
                    "required" => true
                ],
                "smtp_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Mot de passe SMTP :",
                    "placeholder" => "Votre mot de passe SMTP",
                    "error" => "-Format incorrect, votre mot de passe SMTP doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                    "required" => true
                ],
                "smtp_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Confirmation du mot de passe SMTP :",
                    "placeholder" => "Confirmation de votre mot de passe",
                    "confirm" => "smtp_password",
                    "error" => "-Vous avez insérer deux mots de passe SMTP différents",
                    "required" => true
                ],
                "smtp_username" => [
                    "type" => "text",
                    "placeholder" => "Votre nom d'utilisateur SMTP",
                    "min" => 3,
                    "max" => 50,
                    "label" => "Nom d'utilisateur SMTP :",
                    "error" => "-Le nom d'utilisateur SMTP est incorrect, longeur entre 3 et 50 caractères, et ne peut contenir que des lettres (majuscules et minuscules), des chiffres et des caractères de soulignement",
                    "required" => true
                ],
                "smtp_name" => [
                    "type" => "text",
                    "placeholder" => "Votre nom SMTP",
                    "min" => 2,
                    "max" => 45,
                    "label" => "Nom SMTP :",
                    "error" => "-Votre nom SMTP doit faire entre 2 et 45 caractères et ne doit contenir que des lettres",
                    "required" => true
                ],
                "site_name" => [
                    "type" => "text",
                    "min" => 3,
                    "max" => 50,
                    "label" => "Nom du site :",
                    "placeholder" => "Ultimate Portfolio Builder",
                    "error" => "-Nom du site incorrect (minimum 3, maximum 50 caractères, lettres en majuscules et minuscules autorisées, espaces, ainsi que les caractères spéciaux '-' et '_')",
                    "required" => true
                ],
                "site_img" => [
                    "type" => "file",
                    "label" => "Logo du site :",
                    "placeholder" => "Logo du site",
                    "error" => "-Format de l'image incorrect<br>(.PNG ou .JPEG ou .JPG ou .GIF)",
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
