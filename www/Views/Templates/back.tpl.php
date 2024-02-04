
<?php  if ($_SESSION['Account']["role"] == "admin"): ?>
    <!DOCTYPE html>
    <html lang="fr">
        <body>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo SITE_NAME; ?></title>
                <link rel="apple-touch-icon" sizes="180x180" href="../../assets/Framework/public/images/favicon_djimdo.png">
                <link rel="stylesheet" href="../../assets/Framework/src/style.css">
                <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
            </head>
            <main class="d-flex" style="height:100vh">
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
            <footer>
                <script src="../../node_modules/@ckeditpr/keditor5-build-classic/build/ckeditor.js"></script>
                <script type="module" src="../../assets/Framework/src/js/main.js"></script>
            </footer>
        </body>
    </html>
<?php endif; ?>