
<?php if (isset($_SESSION['Account'])): ?>
 <?php if ($_SESSION['Account']['role'] == "admin"): ?>
    <!DOCTYPE html>
    <html lang="fr">
        <body>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?=  SITE_NAME ?></title>
                <link rel="apple-touch-icon" sizes="180x180" href="../../assets/Framework/public/images/favicon_djimdo.png">
                <link rel="stylesheet" href="../../assets/Framework/src/style.css">
                <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
                <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
                <script type="module" src="../../assets/Framework/src/js/main.js"></script>
            </head>
            <main class="d-flex" style="height:100vh">
                <aside class="sidebar">
                    <h1 class="fs-4 mt-1 mb-3">Dashboard (Admin)</h1>
                    <nav class="sidebar-navigation">
                        <ul>
                            <li>
                                <a class="nav-link" href="/">
                                    <i class="ri-store-2-line"></i>
                                    <span>Aller sur le front</span>
                                </a>
                            </li>
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
                                <h3>CRUD</h3>
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
                            <li>
                                <a href="/dashboard/comments" class="nav-links">
                                    <i class="ri-chat-settings-line"></i>
                                    <span>Commentaires</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/users" class="nav-links">
                                    <i class="ri-team-line"></i>
                                    <span>Utilisateurs</span>
                                </a>
                            </li>
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
<?php else: ?>
        <!DOCTYPE html>
        <html lang="fr">
        <body>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?=  SITE_NAME ?></title>
            <link rel="apple-touch-icon" sizes="180x180" href="../../assets/Framework/public/images/favicon_djimdo.png">
            <link rel="stylesheet" href="../../assets/Framework/src/style.css">
            <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
            <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
            <script type="module" src="../../assets/Framework/src/js/main.js"></script>
        </head>
        <main class="d-flex" style="height:100vh">
            <aside class="sidebar">
                <h1 class="fs-4 mt-1 mb-3">Dashboard (Moderateur)</h1>
                <nav class="sidebar-navigation">
                    <ul>
                        <li>
                            <a class="nav-link" href="/">
                                <i class="ri-store-2-line"></i>
                                <span>Aller sur le front</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard">
                                <i class="ri-dashboard-line"></i>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                        <li>
                            <h3>CRUD</h3>
                        <li>
                            <a href="/dashboard/comments" class="nav-links">
                                <i class="ri-chat-settings-line"></i>
                                <span>Commentaires</span>
                            </a>
                        </li>
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
<?php else: ?>
    <?php header('Location: /404'); exit; ?>
<?php endif; ?>