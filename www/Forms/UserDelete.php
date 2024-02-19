<?php

namespace App\Forms;
use App\Core\Verificator;

class UserDelete extends Verificator
{

    protected $method = "POST";
    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "class" => "form",
                "method" => $this->method,
                "action" => "",
                "submit" => "Supprimer",
            ],
            "select" => [
                    "account_delete" => [
                        "label" => "Type de suppression :",
                        "class" => "input-select2 w-8",
                        "options" => [
                            "soft" => "Soft delete",
                            "hard" => "Hard delete",
                        ],
                        "error" => "-Veuillez sélectionner le type de suppression du compte",
                        "required" => true
                    ]
                ],
            "inputs" => [
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
