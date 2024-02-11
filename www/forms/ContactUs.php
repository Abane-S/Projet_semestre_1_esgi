<?php

namespace App\Forms;
use App\Core\Verificator;

class ContactUs extends Verificator
{

    protected $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Nous contacter",
                "class" => "form",
            ],
            "inputs" => [
                "contact_subject" => [
                    "type" => "text",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Sujet : ",
                    "placeholder" => "Comment aller vous",
                    "error" => "",
                    "required" => true
                ],
                "contact_message" => [
                    "type" => "text",
                    "min" => 8,
                    "max" => 45,
                    "label" => "Message : ",
                    "placeholder" => "Bonjour, vous allez bien ?",
                    "error" => "",
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
