<!DOCTYPE html>
<html lang="fr">
    <body>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?=  defined('SITE_NAME') ? SITE_NAME : "" ?></title>
            <link rel="apple-touch-icon" sizes="180x180" href="../../assets/Framework/public/images/favicon_djimdo.png">
            <link rel="stylesheet" href="../../assets/Framework/src/style.css">
            <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
            <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
            <script type="module" src="../../assets/Framework/src/js/main.js"></script>
        </head>
        
        <?php if ( (!isset($showNavbar)) || $showNavbar != "false") : ?>
        <header id="header" class="esgi-header">
            <div class="container">
                <a href="/" class="esgi-logo">
                    <img src="../../assets/Framework/public/images/logo_djimdo_website.png" alt="Logo site"/>
                </a>
                <nav>
                    <ul>
                        <?php if (isset($_SESSION['Account']) && $_SESSION['Account']['role'] == "admin"): ?>
                            <li><a href="/dashboard">Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="/portfolio">Portfolio</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <?php if (isset($_SESSION['Account'])): ?>
                            <li><a href="/account">Compte</a></li>
                            <li><a href="/logout">Déconnexion</a></li>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['Account'])): ?>
                            <li><a href="/login">Connexion</a></li>
                            <li><a href="/register">Inscription</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
        <?php endif; ?>
        <main>  
            <?php include $this->viewName; ?>
        </main>
    </body>
</html>