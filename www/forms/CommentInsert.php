<?php

namespace App\Forms;
// use App\Core;

class CommentInsert extends \App\Core\Form
{


    public static function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" =>  "Poster un commentaire",
                "class" => "form"
            ],

            "inputs"=>[
               "Contenu"=>["type"=>"text","class"=>"input-form", "placeholder"=>"Commentaire", "required"=>true, "error"=>"Le format du contenu est incorrect"]
           ]
        ];
    }
}