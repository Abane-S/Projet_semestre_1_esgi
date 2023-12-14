<?php

namespace App\Forms;
// use App\Core;

class UserLogin extends \App\Core\Form
{
    public function __construct()
    {
        parent::__construct($this->getConfig());
    }


    public static function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" =>  "Se connecter",
                "class" => "form"
            ],

            "inputs"=>[
                "email"=>["type"=>"email", "class"=>"input-form", "placeholder"=>"email", "required"=>true, "error"=>"Le format de l'email est incorrect"],
                "pwd"=>["type"=>"password", "class"=>"input-form", "placeholder"=>"mot de passe", "required"=>true, "error"=>"Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre"],
            ]
        ];
    }
}