<?php

use App\Core\Utils;
?>
<?php if ($_SESSION['Account']["role"] == "admin"): ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimate Portefolio Builder</title>
    <link rel="stylesheet" href="../../assets/Framework/dist/css/style.css">
</head>

<body>
<header id="header" class="esgi-header">
    <div class="container">
        <a href="/" class="esgi-logo">
            <img src="../../assets/Framework/public/images/logo.png" alt="Logo site" />
            <h1>Ultimate Portefolio Builder</h1>
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
    <div id="root">
            <div class="sidebar">
                <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/add_template_page">Templates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/list_comment">Commentaires</a>
                        </li>
                </ul>
            </div>

        <div class="content">
            <div class="info_user">
                <?php include $this->viewName; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php endif; ?>