<?php

namespace App\Forms;


use App\Core\Verificator;


class createPage extends Verificator
{
    protected $method = "POST";

    protected array $config = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getConfig(): array
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => $this->data["submit"] ?? "Créer" ,
                 "class"   => 'form',
                 "enctype" => "multipart/form-data",
            ],
            'inputs' => [
                'title' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => "Title de l'ongle de la page (important pour le SEO)",
                    'value'       => '',
                    'errors'      => "-Le nom de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required"    => true,
                    "value"      => $this->data['titre'] ?? "",
                ],
                "meta_description" => [
                    "type"        => "text",
                    "class"       => "input-form",
                    "placeholder" => "Description courte de la page (encore une fois important pour le SEO)",
                    "value"       => "",
                    "errors"      => "-La meta description de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required"    => true,
                    "value"      => $this->data['description'] ?? "",

                ],
                "titre" => [
                    "type"        => "text",
                    "class"       => "input-form",
                    "placeholder" => "Titre de la page cette fois-ci le titre h1 visible sur la page",
                    "errors"      => "-Le titre de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required"    => true,
                    "value"      => $this->data['title'] ?? "",
                ],
                "menu" => [
                    "type"        => "text",
                    "class"       => "input-form",
                    "placeholder" => "Nom de votre item sur la navbar",
                    "errors"      => "-Le nom de votre menu doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required"    => true,
                    "value"      => $this->data['menu'] ?? "",
                ],
                'images' => [
                    'type'        => 'file',
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'placeholder' => 'image',
                    'value'       => '',
                    'errors'      => [],
                    "required"    => true,
                    "value"      => $this->data['banniere'] ?? "",
                ],
                'content' => [
                    'class'       => 'input-form',
                    'placeholder' => 'Contenu de votre page',
                    'value'       => '',
                    'errors'      => "Votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    'type'       => "textarea",
                    'id'          => "editor",
                    "content"      => $this->data['content'] ?? "",
                    "errors"     => "",

                ],
                "csrf_token" => [
                    "type" => "hidden",
                    "placeholder" => "",
                    "label" => "",
                    "errors" => ""
                ],
            ],
            "select" => [
                "article" => [
                    "label" => "Selectionner un article comme contenu principal",
                    "class" => "input-form",
                    "options" => $this->data['articles'] ?? [],
                    "required" => true,
                    "id" => "article",
                ]
            ],
        ];

        return $this->config;
    }
}