<?php if (isset($_SESSION['Account']) && $_SESSION['Account']['role'] == "admin") : ?>
    <!DOCTYPE html>
    <html lang="fr">
        <body>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?=  defined('SITE_NAME') ? SITE_NAME : "" ?></title>
                <link rel="apple-touch-icon" sizes="180x180" href="/assets/Framework/public/images/favicon_djimdo.png">
                <link rel="stylesheet" href="/assets/Framework/src/style.css">
                <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
                <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
                <script type="module" src="/assets/Framework/src/js/main.js"></script>
            </head>
            <main class="d-flex" style="height:100vh">
                <aside class="sidebar">
                    <h1 class="fs-4 mt-1">Dashboard</h1>
                    <h3 class="mb-3" style="font-weight: 200"><?= $_SESSION['Account']['role'] ?></h3>
                    <nav class="sidebar-navigation">
                        <ul>
                            <li>
                                <a class="nav-link" href="/">
                                    <i class="ri-store-2-line"></i>
                                    <span>Aller sur le site</span>
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
                                <h3>Content</h3>
                                <li>
                                    <a href="/dashboard/pages" class="nav-link">
                                        <i class="ri-pages-line"></i>
                                        <span>Pages</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/dashboard/articles" class="nav-link">
                                        <i class="ri-menu-line"></i>
                                        <span>Articles</span>
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
<?php else: ?>
    <?php header('Location: /404'); exit; ?>
<?php endif; ?>