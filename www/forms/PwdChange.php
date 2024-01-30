<?php

namespace App\Forms;
use App\Core\Verificator;

class PwdChange extends Verificator
{

    protected $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Changer mon mot de passe",
            ],
            "inputs" => [
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Mot de passe :",
                    "placeholder" => "Votre mot de passe",
                    "error" => "-Format du mot de passe incorrect, minimum 8 caractères, maximum 45 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                    "required" => true
                ],
                "user_confirm_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Confirmation mot de passe",
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
