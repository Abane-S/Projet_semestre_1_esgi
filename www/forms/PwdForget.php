<?php

namespace App\Forms;
use App\Core\Verificator;

class PwdForget extends Verificator
{

    protected $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Mot de passe oublié",
            ],
            "inputs" => [
                "user_email" => [
                    "type" => "email",
                    "min" => 5,
                    "max" => 255,
                    "label" => "",
                    "placeholder" => "Votre email",
                    "error" => "Le format de votre email est incorrect (exemple: test@gmail.com)"
                ],
                "csrf_token" => [
                    "type" => "hidden",
                    "placeholder" => "",
                    "label" => "",
                    "error" => ""
                ],
            ]
        ];

        return $this->config;
    }

}
