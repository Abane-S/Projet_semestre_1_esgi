<?php

namespace App\Forms;
use App\Core\Verificator;


class UserLogin extends Verificator
{

    protected $method = "POST";

    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Se Connecter",
                "class" => "form",
            ],
            "inputs" => [
                "user_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "",
                    "placeholder" => "Votre email",
                    "label" => "Adresse email :",
                    "error" => "-L'adresse e-mail ou le mot de passe est incorrecte.",
                    "required" => true
                ],
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "",
                    "label" => "Mot de passe :",
                    "placeholder" => "Votre mot de passe",
                    "error" => "-Le mot de passe est incorrect.",
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
