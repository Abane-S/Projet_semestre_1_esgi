<?php

namespace App\Forms;
class PwdForget
{

    public function getConfig(): array
    {
        return [
            "config"=> [
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mot de passe oublié",
                "class"=>"form",
                "id"=>"form-pwd-forget"
            ],
            "inputs"=>[
                "email"=>["type"=>"email", "class"=>"input-form", "placeholder"=>"Email", "required"=>true, "error"=>"Le format de l'email est incorrect"],
            ]
        ];
    }

}