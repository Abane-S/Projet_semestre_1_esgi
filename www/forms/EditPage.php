<?php

namespace App\Forms;


use App\Core\Verificator;


class EditPage extends Verificator
{
    protected $method = "POST";
    public array $data = [];
    protected array $config = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getConfig(): array
    {
            $this->config = [
                'config' => [
                    "method" => $this->method,
                    "action" => "",
                    "enctype" => "multipart/form-data",
                    "submit" => "Modifier le blog",
                    "class" => "form",
                ],
                "select" => [
                    "page_comment" => [
                        "label" => "Possibilité de commenter :",
                        "class" => "p-1-1 w-8 input-select",
                        "options" => [
                            "1" => "Oui",
                            "0" => "Non",
                        ],
                        "error" => "-Veuillez sélectionner la possibilité de commenter",
                        "required" => true
                    ]
                ],
                'inputs' => [
                    'page_title' => [
                        'type' => 'text',
                        'class' => 'input-form',
                        "label" => "Titre du blog : ",
                        "min" => 3,
                        "max" => 255,
                        'placeholder' => 'Titre du blog',
                        "value" =>  $this->data["title"] ?? "",
                        'error' => "-Le titre de votre blog
                         doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                        "required" => true
                    ],
                    "page_meta_description" => [
                        "type" => "text",
                        "class" => "input-form",
                        "label" => "Description du blog: ",
                        "min" => 3,
                        "max" => 255,
                        "value" =>  $this->data["meta_description"] ?? "",
                        "placeholder" => "Description",
                        "required" => true,
                        "error" => "-La description de votre blog doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    ],
                    "page_file" => [
                        "type" => "file",
                        "label" => "Miniature du blog :",
                        "placeholder" => "Logo du site",
                        "error" => "-Format de l'image incorrect<br>(.PNG ou .JPEG ou .JPG ou .GIF)",
                        "required" => true
                    ],
                    "csrf_token" => [
                        "type" => "hidden",
                        "placeholder" => "",
                        "label" => "",
                        "error" => "",
                        "required" => true
                    ],
                ],
                'textarea' => [
                    "page_content" => [
                        "label" => "Contenue du blog :",
                        'id' => "editor",
                        "value" =>  $this->data["content"] ?? "",
                        'name' => "page_content",
                        "error" => "-Le contenue ne peut etre vide",
                    ]
                ],
            ];
        return $this->config;
    }
}