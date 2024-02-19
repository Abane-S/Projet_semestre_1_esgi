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
        if($this->data["comments"])
        {
            $this->config = [
                'config' => [
                    "method" => $this->method,
                    "action" => "",
                    "enctype" => "multipart/form-data",
                    "submit" => "Modifier la page",
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
                        "label" => "Titre de la page : ",
                        "min" => 3,
                        "max" => 255,
                        'placeholder' => 'Titre de la page',
                        "value" =>  $this->data["title"] ?? "",
                        'error' => "-Le titre de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                        "required" => true
                    ],
                    "page_meta_description" => [
                        "type" => "text",
                        "class" => "input-form",
                        "label" => "Description : ",
                        "min" => 3,
                        "max" => 255,
                        "value" =>  $this->data["meta_description"] ?? "",
                        "placeholder" => "Description",
                        "required" => true,
                        "error" => "-La description de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                    ],
                    "page_file" => [
                        "type" => "file",
                        "label" => "Miniature de la page :",
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
                        "value" =>  $this->data["content"] ?? "",
                        'name' => "page_content",
                        "error" => "-Le contenue ne peut etre vide",
                    ]
                ],
            ];
        }
        else
        {
                $this->config = [
                    'config' => [
                        "method" => $this->method,
                        "action" => "",
                        "enctype" => "multipart/form-data",
                        "submit" => "Modifier la page",
                        "class" => "form",
                    ],
                    "select" => [
                        "page_comment" => [
                            "label" => "Possibilité de commenter :",
                            "class" => "p-1-1 w-8 input-select",
                            "options" => [
                                "0" => "Non",
                                "1" => "Oui",
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
                            "value" =>  $this->data["title"] ?? "",
                            'placeholder' => 'Titre de la page',
                            'error'      => "-Le titre de votre page doit contenir au moins 3 caractères et ne doit pas dépasser 255 caractères.",
                            "required" => true
                        ],
                        "page_meta_description" => [
                            "type"        => "text",
                            "class"       => "input-form",
                            "label" => "Meta description : ",
                            "value" =>  $this->data["meta_description"] ?? "",
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
                            'name' => "page_content",
                            "value" =>  $this->data["content"] ?? "",
                            "error" => "-Le contenue ne peut etre vide",
                        ]
                    ],
                ];
        }

        return $this->config;
    }
}