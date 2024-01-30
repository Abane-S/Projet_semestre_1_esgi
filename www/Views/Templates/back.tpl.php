<?php

use App\Core\Utils;
?>
<?php if ($_SESSION['Account']["role"] == "admin"): ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJIMDO</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/Framework/public/images/favicon_djimdo.png">
    <link rel="stylesheet" href="../../assets/Framework/src/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="../../assets/Framework/src/js/main.js"></script>
</head>

<body>
<!-- <header id="header" class="esgi-header"> -->
    <!-- <div class="container">
        <a href="/" class="esgi-logo">
            <img src="../../assets/Framework/public/images/logo_djimdo_website.png" alt="Logo site" style="width: 4rem"/>
        </a>
        <nav>
            <ul>
                <?php //if (isset($_SESSION['Account']) && $_SESSION['Account']['role'] == "admin"): ?>
                    <li><a href="/dashboard">Dashboard</a></li>
                <?php //endif; ?>
                <li><a href="/portfolio">Portfolio</a></li>
                <li><a href="/contact">Contact</a></li>
                <?php //if (isset($_SESSION['Account'])): ?>
                    <li><a href="/account">Compte</a></li>
                    <li><a href="/logout">Déconnexion</a></li>
                <?php //endif; ?>
                <?php //if (!isset($_SESSION['Account'])): ?>
                    <li><a href="/login">Connexion</a></li>
                    <li><a href="/register">Inscription</a></li>
                <?php //endif; ?>
            </ul>
        </nav>
    </div> -->
<!-- </header> -->
    <main class="dashboard">
        <aside class="sidebar">
            <h1 class="fs-4 mt-1 mb-3">Dashboard</h1>
            <nav class="sidebar-navigation">
                <ul>
                    <li>
                        <a class="nav-link" href="/dashboard">
                        <i class="ri-dashboard-line"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/">
                            <i class="ri-equalizer-line"></i>
                            <span>Style du site</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/">
                            <i class="ri-store-2-line"></i>
                            <span>Aller sur le site</span>
                        </a>
                    </li>
                    <li>
                        <h3>Content</h3>
                        <li>
                            <a href="/dashboard/pages" class="nav-link">
                                <i class="ri-pages-line"></i>
                                <span>Pages</span>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard/menus" class="nav-link">
                                <i class="ri-menu-line"></i>
                                <span>Menus</span>
                            </a>
                        </li>
                    </li>
                    <li>
                        <h3>Modération</h3>
                        <ul>
                            <li>
                                <a href="/dashboard/comments" class="nav-links">
                                    <i class="ri-chat-settings-line"></i>
                                    <span>Commentaires</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h3>Settings</h3>
                        <ul>
                            <li>
                                <a href="/dashboard/users" class="nav-links">
                                    <i class="ri-team-line"></i>
                                    <span>Utilisateurs</span>
                                </a>
                            </li>
                            <li>
                                <a href="/account" class="nav-links">
                                    <i class="ri-account-circle-fill"></i>
                                    <span>Profil</span>
                                </a>
                            </li>
                            <li>
                                <a href="/logout" class="nav-links">
                                    <i class="ri-logout-box-line"></i>
                                    <span>logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside> 
        <section class="content">
            <?php include $this->viewName; ?>  
        </section>
    </main>
</body>
</html>
<?php endif; ?>