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
                'method' => 'POST',
                'action' => '',
                'submit' => 'Créer',
                 "class"   => 'form',
            ],
            'inputs' => [
                'name' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom de l\'article',
                    'value'       => '',
                    'errors'      => "-Le nom de votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                ],
                'category' => [
                    'input'       => "textarea",
                    'type'        => 'text',
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'placeholder' => 'catégorie',
                    'value'       => '',
                    'errors'      => "-La catégorie de votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                ],
                "meta_description" => [
                    "type"        => "text",
                    "class"       => "input-form",
                    "placeholder" => "meta description",
                    "value"       => "",
                    "errors"      => "-La meta description de votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                ],
                'images' => [
                    'type'        => 'file',
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'placeholder' => 'image',
                    'value'       => '',
                    'errors'      => [],
                ],
                'description' => [
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => '',
                    'errors'      => "-La description de votre article doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    'type'       => "textarea",
                    'id'          => "editor",
                ],
            ],
        ];

        return $this->config;
    }
}