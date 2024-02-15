<?php

namespace App\Forms;


use App\Core\Verificator;


class createArticle extends Verificator
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
                'titre' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'Titre de l\'article',
                    'value'       => '',
                    'errors'      => "Le nom de votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required"    => true,
                    "value"      => $this->data['titre'] ?? "",
                ],
                "description" => [
                    "type"        => "text",
                    "class"       => "input-form",
                    "placeholder" => "Description courte de l'article",
                    "value"       => "",
                    "errors"      => "La meta description de votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    "required"    => true,
                    "value"      => $this->data['description'] ?? "",

                ],
                'images' => [
                    'type'        => 'file',
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'placeholder' => 'image',
                    'value'       => '',
                    'errors'      => [],
                    "required"    => true,
                    "value"      => $this->data['miniature'] ?? "",
                ],
                "comments" => [
                    "type"        => "checkbox",
                    "class"       => "input-form",
                    "placeholder" => "commentaire",
                    "value"       => "",
                    "errors"      => [],
                    
                ],
                'content' => [
                    'class'       => 'input-form',
                    'placeholder' => 'Contenu de votre article',
                    'value'       => '',
                    'errors'      => "Votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
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
        ];

        return $this->config;
    }
}