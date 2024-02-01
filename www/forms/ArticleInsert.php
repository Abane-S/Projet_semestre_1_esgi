<?php

namespace App\Forms;


class ArticleInsert 


{

    public static function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" =>  "Créer un article",
                "class" => "form"
            ],

            "inputs"=>[
                "Titre"=>["type"=>"text","class"=>"input-form-titre", "placeholder"=>"Titre", "required"=>true, "error"=>"Le format du titre est incorrect"],
                "Catégorie"=>["type"=>"select","class"=>"select-form", "placeholder"=>"Catégorie", "required"=>true, "error"=>"Veillez séléctionner une catégorie"],
                "Contenu"=>["type"=>"text","class"=>"input-form", "placeholder"=>"Contenu", "required"=>true, "error"=>"Le format du contenu est incorrect","option"=>[1=>"test", 2=>"test2", 3=>"Autre"]]
            ]
        ];
    }
}