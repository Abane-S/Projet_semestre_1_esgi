<?php

namespace App\forms;
use App\Core\Verificator;


class Adminnstaller extends Verificator
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
            "inputs" => [
                "user_firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "min" => 2,
                    "max" => 45,
                    "label" => "Prénom :",
                    "error" => "Votre prénom doit faire entre 2 et 45 caractères et ne doit contenir que des lettres",
                    "required" => true
                ],
                "user_lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom de famille",
                    "min" => 2,
                    "max" => 45,
                    "label" => "Nom de famille :",
                    "error" => "Votre nom de famille doit faire entre 2 et 45 caractères et ne doit contenir que des lettres",
                    "required" => true
                ],
                "user_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "Adresse email :",
                    "placeholder" => "Votre email",
                    "error" => "Le format de votre email est incorrect (exemple: test@gmail.com)",
        "required" => true
                ],
                "user_confirm_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "Confirmation adresse email :",
                    "placeholder" => "Confirmation de votre email",
                    "confirm" => "user_email",
                    "error" => "Vous avez insérer deux emails différents",
                    "required" => true
                ],
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Mot de passe :",
                    "placeholder" => "Votre mot de passe",
                    "error" => "Format incorrect, votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
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
