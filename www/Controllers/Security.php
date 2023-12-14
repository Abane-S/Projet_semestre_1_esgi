<?php 

namespace App\Controllers;
use App\Core\View;

class Security
{
    public function login(): void
    {
        // echo "Ma page de login";
        $myView = new View("Security/login", "front");
    }
    
    public function logout(): void
    {
        echo "Ma page de déconnexion";
    }

    public function register(): void
    {
        $myView = new View("Security/register", "front");
    }

}