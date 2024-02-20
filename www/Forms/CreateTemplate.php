<?php

namespace App\Forms;


use App\Core\Verificator;


class CreateTemplate extends Verificator
{
    protected $method = "POST";
    public array $data = [];
    protected array $config = [];

    public function getConfig(): array
    {
            $this->config = [
                'config' => [
                    'method' => 'POST',
                    'action' => '',
                    'submit' => 'Créer',
                    "class" => 'form',
                ],
                "inputs" => [
                    "style_size" => [
                        "type" => "number",
                        "id" => "preview-size",
                        "placeholder" => "Taille de la police du site",
                        "min" => 5,
                        "max" => 100,
                        "value" => 15,
                        "label" =>  "Taille de la police du site (px)",
                        "error" => "-Merci de séléctionner une taille de police valide (min 5px et max 100px)",
                        "required" => true
                    ],
                    "style_name" => [
                        "type" => "text",
                        "placeholder" => "Nom du template",
                        "min" => 3,
                        "max" => 50,
                        "label" =>  "Nom du template :",
                        "error" => "-Le nom du template est incorrect, longeur entre 3 et 50 caractères, et ne peut contenir que des lettres (majuscules et minuscules), des chiffres et des caractères de soulignement",
                        "required" => true
                    ],
                    "style_background_color" => [
                        "type" => "color",
                        "class" => "form-input-color",
                        "id" => "preview-bkcolor",
                        "placeholder" => "Couleur du background",
                        "label" => "Couleur du background :",
                        "error" => "-La couleur est incorrect",
                        "required" => true
                    ],
                    "style_text_color" => [
                        "type" => "color",
                        "class" => "form-input-color",
                        "id" => "preview-txtcolor",
                        "placeholder" => "Couleur des textes",
                        "label" =>"Couleur des textes :",
                        "error" => "-La couleur est incorrect",
                        "required" => true
                    ],
                    "style_navbar_color" => [
                        "type" => "color",
                        "class" => "form-input-color",
                        "id" => "preview-navcolor",
                        "placeholder" => "Couleur de la navbar",
                        "label" =>"Couleur de la navbar :",
                        "error" => "-.",
                        "required" => true
                    ],
                    "style_navbar2_color" => [
                        "type" => "color",
                        "class" => "form-input-color",
                        "id" => "preview-navmenucolor",
                        "placeholder" => "Couleur des menus de la navbar",
                        "label" =>"Couleur des menus de la navbar :",
                        "error" => "-La couleur est incorrect",
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
                    "style_police" => [
                        "label" => "Selectionner la police du site :",
                        "class" => "p-1-1 w-8 input-select",
                        "id" => "preview-font",
                        "options" => [
                                "'Euclid Circular Regular', sans-serif" => "Euclid Circular Regular (sans-serif)",
                                "'Arial', sans-serif" => "Arial (sans-serif)",
                                "'Arial Black', sans-serif" => "Arial Black (sans-serif)",
                                "'Helvetica', sans-serif" => "Helvetica (sans-serif)",
                                "'Verdana', sans-serif" => "Verdana (sans-serif)",
                                "'Tahoma', sans-serif" => "Tahoma (sans-serif)",
                                "'Trebuchet MS', sans-serif" => "Trebuchet (sans-serif)",
                                "'MS', sans-serif" => "MS (sans-serif)",
                                "'MS', serif" => "MS (serif)",
                                "'MS', cursive" => "MS (cursive)",
                                "'MS', system-ui" => "MS (system-ui)",
                                "'Impact', sans-serif" => "Impact (sans-serif)",
                                "'Gill Sans', sans-serif" => "Gill Sans (sans-serif)",
                                "'Gill Sans', serif" => "Gill Sans (serif)",
                                "'Gill Sans', cursive" => "Gill Sans (cursive)",
                                "'Gill Sans', system-ui" => "Gill Sans (system-ui)",
                                "'Times New Roman', serif" => "Times New Roman (serif)",
                                "'Georgia', serif" => "Georgia (serif)",
                                "'Palatino', serif" => "Palatino (serif)",
                                "'Andalé Mono', monospace" => "Andalé Mono (monospace)",
                                "'Courier New', monospace" => "Courier (monospace)",
                                "'Monaco', monospace" => "Monaco (monospace)",
                                "'Bradley Hand', cursive" => "Bradley Hand (cursive)",
                                "'Brush Script MT', cursive" => "Brush Script MT (cursive)",
                                "'Luminari', fantasy" => "Luminari (fantasy)",
                                "'Comic Sans MS', cursive" => "Comic Sans MS (cursive)",
                                "'Arial Narrow', sans-serif" => "Arial Narrow (sans-serif)",
                                "'Courier', monospace" => "Courier (monospace)",
                                "'Geneva', sans-serif" => "Geneva (sans-serif)",
                                "'Bookman', serif" => "Bookman (serif)",
                                "'Avant Garde', sans-serif" => "Avant Garde (sans-serif)",
                                "'Copperplate', serif" => "Copperplate (serif)",
                                "'Futura', sans-serif" => "Futura (sans-serif)",
                                "'Century Gothic', sans-serif" => "Century Gothic (sans-serif)",

        ],
                        "error" => "-Veuillez sélectionner une police de site web valide",
                        "required" => true
                    ]
                ],
            ];

        return $this->config;
    }
}




