<?php

namespace App\forms;
class ModifieAccount
{

    public function getConfig(): array
    {
        return [
            "config"=> [
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Modifier",
                "class"=>"form",
                "id"=>"form-pwd-change"
            ],
            "inputs"=>[
                "firstname"=>["type"=>"text", "class"=>"input-form" , "placeholder"=>"Prénom", "minlen"=>2, "required"=>true, "error"=>"Le prénom doit faire plus de 2 caractères"],
                "lastname"=>["type"=>"text", "class"=>"input-form", "placeholder"=>"Nom", "minlen"=>2, "required"=>true, "error"=>"Le nom doit faire plus de 2 caractères"],
                "email"=>["type"=>"email", "class"=>"input-form", "placeholder"=>"Email", "required"=>true, "error"=>"Le format de l'email est incorrect"],
                "newpwd"=>["type"=>"password", "class"=>"input-form", "placeholder"=>"Nouveau mot de passe", "required"=>true, "error"=>"Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre"],
                "pwdConfirm"=>["type"=>"password", "class"=>"input-form", "confirm"=>"pwd" ,"placeholder"=>"Confirmation du nouveau mot de passe", "required"=>true, "error"=>"Votre mot de passe de confirmation ne correspond pas"],
            ]
        ];
    }

}