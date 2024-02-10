<?php

namespace App\Forms;
use App\Core\Verificator;


class CommentInsert extends Verificator
{

    protected $method = "POST";

    protected array $config = [];

    public function getConfig(): array
    {
        $this->config =  [
            "config" => [
                "method" => $this->method,
                "action" => "",
                "submit" => "Poster un commentaire",
                "class" => "form",
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
                    "label" => "Commentaire :",
                    "placeholder" => "Commentaire",
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
