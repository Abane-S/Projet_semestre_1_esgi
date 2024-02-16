<?php

function CompareURI($uriToCheck): bool
{
    $uri = strtolower($_SERVER["REQUEST_URI"]);
    $uri = strtok($uri, "?");
    $uri = strlen($uri) > 1 ? rtrim($uri, "/") : $uri;

    return $uriToCheck == $uri;
}

?>


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

                <img style="width: 7rem;
    height: 7rem;" src=<?=  defined('SITE_LOGO') ? SITE_LOGO : "../../assets/Framework/public/images/logo_djimido_website.png" ?> alt="Logo site"/>
            </a>
            <nav>
                <ul>

                    <?php if (isset($_SESSION['Account']) && $_SESSION['Account']['role'] == "admin"): ?>
                        <i class="ri-dashboard-line"></i><li><a href="/dashboard">Dashboard (Back)</a></li>
                    <?php endif; ?>
                    <?php if (CompareURI('/')): ?>
                        <i class="ri-pages-line"></i><li><a style="color:#2256FA" href="/">Pages</a></li>
                    <?php else: ?>
                        <i class="ri-pages-line"></i><li><a href="/">Pages</a></li>
                    <?php endif; ?>

                    <?php if (CompareURI('/contact')): ?>
                        <i class="ri-chat-settings-line"></i><li><a style="color:#2256FA" href="/contact">Contact</a></li>
                    <?php else: ?>
                        <i class="ri-chat-settings-line"></i><li><a href="/contact">Contact</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['Account'])): ?>
                        <?php if (CompareURI('/account')): ?>
                            <i class="ri-account-circle-fill"></i><li><a style="color:#2256FA"  href="/account">Compte</a></li>
                        <?php else: ?>
                            <i class="ri-account-circle-fill"></i><li><a href="/account">Compte</a></li>
                        <?php endif; ?>
                        <?php if (CompareURI('/logout')): ?>
                            <i class="ri-logout-box-line"></i><li><a style="color:#2256FA" href="/logout">Déconnexion</a></li>
                        <?php else: ?>
                            <i class="ri-logout-box-line"></i><li><a href="/logout">Déconnexion</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['Account'])): ?>
                        <?php if (CompareURI('/login')): ?>
                            <i class="ri-login-box-line"></i><li><a style="color:#2256FA" href="/login">Connexion</a></li>
                        <?php else: ?>
                            <i class="ri-login-box-line"></i><li><a href="/login">Connexion</a></li>
                        <?php endif; ?>
                        <?php if (CompareURI('/register')): ?>
                            <i class="mdi--register-outline"></i><li><a style="color:#2256FA" href="/register">Inscription</a></li>
                        <?php else: ?>
                            <i class="mdi--register-outline"></i><li><a href="/register">Inscription</a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php

                    $menu = new App\Models\Menus();
                    $menuAll = $menu->getAllMenu();

                    if(isset($menuAll) && !empty($menuAll)) {
                        foreach ($menuAll as $item) {
                            if (CompareURI("/menu/{$item['id']}"))
                            {
                                echo "<i class='{$item['icon_menu']}'></i><li><a style='color:#2256FA' href='/menu/{$item['id']}'>{$item['title_menu']}</a></li>";
                            }
                            else
                            {
                                echo "<i class='{$item['icon_menu']}'></i><li><a href='/menu/{$item['id']}'>{$item['title_menu']}</a></li>";
                            }
                        }
                    }
                    ?>

                </ul>
            </nav>
        </div>
    </header>
<?php endif; ?>
<main>
    <?php include $this->viewName; ?>
</main>
</body>
</html>z