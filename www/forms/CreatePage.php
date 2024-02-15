<?php

namespace App\Forms;


use App\Core\Verificator;


class CreatePage extends Verificator
{
    protected $method = "POST";

    protected array $config = [];

    public function getConfig(): array
    {
        $this->config = [
            'config' => [
                "method" => $this->method,
                "action" => "",
                "enctype" => "multipart/form-data",
                "submit" => "Créer la page",
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
                    "error" => "-Veuillez sélectionner un ...comment",
                    "required" => true
                ]
            ],
            'inputs' => [
                'page_title' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    "label" => "Titre de la page : ",
                    'placeholder' => 'Titre de la page',
                    'error'      => "-Le titre de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required" => true
                ],
                "page_meta_description" => [
                    "type"        => "text",
                    "class"       => "input-form",
                    "label" => "Meta description : ",
                    "placeholder" => "meta description",
                    "required" => true,
                    "error"      => "-La meta description de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                ],
                "page_file" => [
                    "type" => "file",
                    "label" => "Miniature du site :",
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
                    "label" => "Contenue de la page :",
                    'id' => "editor",
                    "placeholder" => "Contenue du site",
                    'name' => "page_content",
                    "error" => "-Le contenue ne peut etre vide",
                ]
            ],
        ];

        return $this->config;
    }
}