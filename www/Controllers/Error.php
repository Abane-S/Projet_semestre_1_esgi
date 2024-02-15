<?php

namespace App\Controllers;
use App\Core\View;

class Error{
    public function page404(): void
    {
        // Modifier le code de réponse HTTP pour 404
        http_response_code(404);
        
        // Affichez votre contenu personnalisé pour la page 404
        $view = new View("Security/404", "front");
        $view->assign("showNavbar", "false");
    }
    
}