<?php

namespace App\Forms;
use App\Core\Verificator;

class ModifieAccount extends Verificator
{

    protected $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Modifier",
            ],
            "inputs" => [
                "user_firstname" => [
                    "type" => "text",
                    "placeholder" => "Votre prénom",
                    "min" => 2,
                    "max" => 45,
                    "label" => "",
                    "error" => "-Votre prénom doit faire entre 2 et 45 caractères et ne doit contenir que des lettres.",
                    "required" => true
                ],
                "user_lastname" => [
                    "type" => "text",
                    "placeholder" => "Votre nom de famille",
                    "min" => 2,
                    "max" => 45,
                    "label" => "",
                    "error" => "-Votre nom de famille doit faire entre 2 et 45 caractères et ne doit contenir que des lettres.",
                    "required" => true
                ],
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "",
                    "placeholder" => "Votre mot de passe",
                    "error" => "-Format du mot de passe incorrect, minimum 8 caractères, maximum 45 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                    "required" => true
                ],
                "user_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "",
                    "placeholder" => "Confirmation de votre mot de passe",
                    "confirm" => "user_password",
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
