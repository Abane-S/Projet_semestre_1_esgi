<?php


namespace App\forms;

use App\Core\Verificator;


class CommentUpdate extends Verificator
{

    protected $method = "POST";

    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Modifier le commentaire",
                "class" => "form",
            ],
            "select" => [
                "comment_valid" => [
                    "label" => "Validité : ",
                    "class" => "p-1-1 w-8 input-select",
                    "options" => [
                        "1" => "Valide",
                        "0" => "Non Valide",
                    ],
                    "error" => "-Veuillez sélectionner si le commentaire est valide ou non",
                    "required" => true
                ]
            ],
            "inputs" => [
                "comment_title" => [
                    "type" => "text",
                    "min" => 1,
                    "max" => 60,
                    "placeholder" => "Titre",
                    "label" => "Titre :",
                    "error" => "-Le titre du commentaire est incorrect (1 caractère min et 60 caractères max).",
                    "required" => true
                ],
                "comment" => [
                    "type" => "text",
                    "min" => 1,
                    "max" => 600,
                    "label" => "Comments :",
                    "placeholder" => "Comments",
                    "error" => "-Le commentaire est incorrect (1 caractère min et 600 caractères max)",
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
