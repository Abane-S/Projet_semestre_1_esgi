<?php

namespace App\forms;


use App\Core\Verificator;


class EditUser extends Verificator
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
        if($this->data["role"] == "user" || $this->data["role"] == "admin") {
            $this->config = [
                'config' => [
                    'method' => 'POST',
                    'action' => '',
                    'submit' => 'Modifier',
                    "class" => 'form',
                ],
                "inputs" => [
                    "user_firstname" => [
                        "type" => "text",
                        "placeholder" => "prénom",
                        "min" => 2,
                        "max" => 45,
                        "value" => $this->data["firstname"] ?? "",
                        "label" => "Prénom :",
                        "error" => "-Votre prénom doit faire entre 2 et 45 caractères et ne doit contenir que des lettres.",
                        "required" => true
                    ],
                    "user_lastname" => [
                        "type" => "text",
                        "placeholder" => "Nom",
                        "min" => 2,
                        "max" => 45,
                        "label" => "Nom de famille :",
                        "value" => $this->data["lastname"] ?? "",
                        "error" => "-Votre nom de famille doit faire entre 2 et 45 caractères et ne doit contenir que des lettres.",
                        "required" => true
                    ],
                    "user_email" => [
                        "type" => "Email",
                        "min" => 5,
                        "max" => 255,
                        "label" => "Adresse email :",
                        "placeholder" => "Votre email :",
                        "value" => $this->data["email"] ?? "",
                        "error" => "-Le format de votre email est incorrect (exemple: test@gmail.com).",
                        "required" => true
                    ],
                    "user_password" => [
                        "type" => "password",
                        "min" => 8,
                        "max" => 45,
                        "label" => "Mot de passe :",
                        "placeholder" => "Votre mot de passe",
                        "error" => "-Format du mot de passe incorrect, minimum 8 caractères, maximum 45 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                        "required" => true
                    ],
                    "user_confirm_password" => [
                        "type" => "password",
                        "min" => 8,
                        "max" => 45,
                        "label" => "Confirmation de son mot de passe :",
                        "placeholder" => "Confirmation de son mot de passe",
                        "confirm" => "user_password",
                        "error" => "-Vous avez insérer deux mots de passe différents",
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
                "select" => [
                    "role" => [
                        "label" => "Selectionner le rôle de l'utilisateur :",
                        "class" => "p-1-1 w-8 input-select",
                        "options" => [
                            "user" => "Utilisateur",
                            "moderateur" => "Modérateur",
                        ],
                        "error" => "-Veuillez sélectionner un rôle de l'utilisateur valide",
                        "required" => true
                    ]
                ],
            ];
        }
        else
            {
                $this->config = [
                    'config' => [
                        'method' => 'POST',
                        'action' => '',
                        'submit' => 'Modifier',
                        "class" => 'form',
                    ],
                    "inputs" => [
                        "user_firstname" => [
                            "type" => "text",
                            "placeholder" => "prénom",
                            "min" => 2,
                            "max" => 45,
                            "value" => $this->data["firstname"] ?? "",
                            "label" => "Prénom :",
                            "error" => "-Votre prénom doit faire entre 2 et 45 caractères et ne doit contenir que des lettres.",
                            "required" => true
                        ],
                        "user_lastname" => [
                            "type" => "text",
                            "placeholder" => "Nom",
                            "min" => 2,
                            "max" => 45,
                            "label" => "Nom de famille :",
                            "value" => $this->data["lastname"] ?? "",
                            "error" => "-Votre nom de famille doit faire entre 2 et 45 caractères et ne doit contenir que des lettres.",
                            "required" => true
                        ],
                        "user_email" => [
                            "type" => "Email",
                            "min" => 5,
                            "max" => 255,
                            "label" => "Adresse email :",
                            "placeholder" => "Votre email :",
                            "value" => $this->data["email"] ?? "",
                            "error" => "-Le format de votre email est incorrect (exemple: test@gmail.com).",
                            "required" => true
                        ],
                        "user_password" => [
                            "type" => "password",
                            "min" => 8,
                            "max" => 45,
                            "label" => "Mot de passe :",
                            "placeholder" => "Votre mot de passe",
                            "error" => "-Format du mot de passe incorrect, minimum 8 caractères, maximum 45 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial parmi \"@#$%^&*()_+=[\]{}|;:'\",<.>/?~\\!\" ",
                            "required" => true
                        ],
                        "user_confirm_password" => [
                            "type" => "password",
                            "min" => 8,
                            "max" => 45,
                            "label" => "Confirmation de son mot de passe :",
                            "placeholder" => "Confirmation de son mot de passe",
                            "confirm" => "user_password",
                            "error" => "-Vous avez insérer deux mots de passe différents",
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
                    "select" => [
                        "role" => [
                            "label" => "Selectionner le rôle de l'utilisateur :",
                            "class" => "p-1-1 w-8 input-select",
                            "options" => [
                                "moderateur" => "Modérateur",
                                "user" => "Utilisateur",
                            ],
                            "error" => "-Veuillez sélectionner un rôle de l'utilisateur valide",
                            "required" => true
                        ]
                    ],
                ];
            }


        return $this->config;
    }
}