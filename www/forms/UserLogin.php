<?php

namespace App\Forms;
use App\Core\verificator;


class UserLogin extends verificator
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
            ],
            "inputs" => [
                "user_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "",
                    "placeholder" => "Votre email",
                    "error" => "L'email ou le mot de passe est incorrect"
                ],
                "user_password" => [
                    "type" => "password",
                    "min" => 8,
                    "max" => 45,
                    "label" => "",
                    "placeholder" => "Votre mot de passe",
                    "error" => "L'email ou le mot de passe est incorrect"
                ],
            ]
        ];

        return $this->config;
    }
}
