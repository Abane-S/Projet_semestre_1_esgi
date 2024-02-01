<!DOCTYPE html>
<html lang="fr">
    <body>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>DJIMDO</title>
            <link rel="icon" type="image/png" href="../../assets/Framework/public/images/favicon_djimdo.png">
            <link rel="stylesheet" href="../../assets/Framework/src/style.css">
            <script type="module" src="../../assets/Framework/src/js/main.js"></script>
        </head>

        <main>
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
            <section>
                <?php include $this->viewName; ?>
            </section>
        </main>
        <footer>
        </footer>
    </body>
</html>