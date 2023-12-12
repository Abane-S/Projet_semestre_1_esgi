<?php
namespace App\Core;

class Form {
    private $config = array();


    public static function render($config): string {

        // var_dump($config);
        
        $form ='';
        $form = $form.'<form';
        foreach ($config['config'] as $name => $input) {
            $form = $form.' '.$name.'="'.$input.'"';
        }
        '>';
        foreach ($config['inputs'] as $name => $input) {
            $form = $form.'<div>';
            $form = $form.'<label for="'.$name.'">'.ucfirst($input['placeholder']).':</label>';
            $form = $form.'<input';
            foreach ($input as $attr => $value) {
                $form = $form.' '.$attr.'="'.$value.'"';
            }
            $form = $form.'>';
            $form = $form.'</div>';
        }
        $form = $form.'<input type="submit" value="'.$config['config']['submit'].'">';
        $form = $form.'</form>';

        // echo $form; 
        return $form;
    }
}