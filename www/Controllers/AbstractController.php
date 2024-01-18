<?php

namespace App\Controllers;

use  App\Core\View;

class AbstractController
{
    public function redirect(string $name): void
    {
        header("Location: " . $name);
    }

    
}