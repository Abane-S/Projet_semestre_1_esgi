<!-- DESIGN GUIDE -->
<section>
    <h1>button</h1>
    <section>
        <a href="#" class="button button-primary button-lg">Button</a>
        <a href="#" class="button button-primary button-md">Button</a>
        <a href="#" class="button button-primary button-sm">Button</a>
    </section>
    <section>
        <button class="button button-secondary button-lg">Button</button>
        <button href="#" class="button button-secondary button-md">Button</button>
        <button href="#" class="button button-secondary button-sm">Button</button>
    </section>
    <section>
        <button class="button button-danger button-lg">Button</button>
        <button href="#" class="button button-danger button-md">Button</button>
        <button href="#" class="button button-danger button-sm">Button</button>
    </section>
    <section>
        <button class="button button-succes button-lg">Button</button>
        <button href="#" class="button button-succes button-md">Button</button>
        <button href="#" class="button button-succes button-sm">Button</button>
    </section>
</section>
<br>
<hr>
<section>
    <h1>blog banner</h1>
    <article class="article-container">
        <header class="article-header">
            <img src="https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171_1280.jpg" alt="">
        </header>
    </article>
</section>
<hr>
<section>
    <h1>blog card</h1>
<article class="card">
    <img src="https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171_1280.jpg">
    <h1>Nom du blog</h1>
    <p>
        Descritpion du blog                        </p>
    <a href="/page/1">
        <button class="w-10 button button-primary button-md w-">Voir le blog</button>
    </a>
</article>
</section>
<hr>
<br>
<section>
    <h1>grid</h1>
    <hr />
    <div class="grid">
        <div class="row">
            <div class="col-2">
                <div class="content">Test</div>
            </div>
            <div class="col-2">
                <div class="content">Test 2</div>
            </div>
            <div class="col-8">
                <div class="content">Test 3</div>
            </div>
        </div>
    </div>
</section>
<hr>
<section>
    <h1>Navbar (front)</h1>
<header id="header" class="esgi-header">
    <div class="container">
        <a href="/" class="esgi-logo">

            <img style="width: 7rem;
    height: 7rem;" src=<?=  defined('SITE_LOGO') ? SITE_LOGO : "../../assets/Framework/public/images/logo_djimido_website.png" ?> alt="Logo site"/>
        </a>
        <nav>
            <ul>

                <?php if (isset($_SESSION['Account'])): ?>
                    <?php if ($_SESSION['Account']['role'] == "admin" || $_SESSION['Account']['role'] == "moderateur"): ?>
                        <i class="ri-dashboard-line"></i><li><a href="/dashboard">Dashboard (Back)</a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <i class="ri-pages-line"></i><li><a id="navbarMain" href="/">Blogs</a></li>
                <i class="ri-chat-settings-line"></i><li><a id="navbarContact" href="/contact">Contact</a></li>
                <?php if (isset($_SESSION['Account'])): ?>
                    <i class="ri-account-circle-fill"></i><li><a id="navbarAccount" href="/account">Compte</a></li>
                    <i class="ri-logout-box-line"></i><li><a href="/logout">Déconnexion</a></li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['Account'])): ?>
                    <i class="ri-login-box-line"></i><li><a id="navbarLogin" href="/login">Connexion</a></li>
                    <i class="mdi--register-outline"></i><li><a id="navbarRegister" href="/register">Inscription</a></li>
                <?php endif; ?>

                <?php

                $menu = new App\Models\Menus();
                $menuAll = $menu->ORMLiteSQL("SELECT");

                if(isset($menuAll) && !empty($menuAll)) {
                    foreach ($menuAll as $item) {
                        echo "<i class='{$item['icon_menu']}'></i><li><a id='navbarMenu'' href='/menu/{$item['id']}'>{$item['title_menu']}</a></li>";
                    }
                }
                ?>

            </ul>
        </nav>
    </div>
</header>
</section>
<hr>
<section>
    <h1>Navbar (back)</h1>
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
                        <h3>CRUD</h3>
                    <li>
                        <a class="nav-link" href="/dashboard/template">
                            <i class="ri-equalizer-line"></i>
                            <span>Templates</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/pages" class="nav-link">
                            <i class="ri-pages-line"></i>
                            <span>Blogs</span>
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
    </main>
</section>
<hr>
<section>
    <h1>Modal</h1>
    <a href="/designGuideModal" class="button button-succes button-lg">Ouvire la modal</a>
    <?php
    if (isset($modal)) {
        $this->includeComponent("modal", $modal);
    }
    ?>
</section>
<hr>
<section>
    <h1>Loader</h1>
    <div class="loader-dot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</section>
<hr>
<section>
    <h1>form</h1>
<div class="form divform ml-auto mr-auto center-form mt-4">
        <label for="contact_subject">Exemple : </label>
        <input name="contact_subject" type="text" class="" placeholder="Exemple" value="" required="">
    <label for="contact_subject">Exemple : </label>
    <select name="account_delete" class="input-select2 w-8">
        required
        <option value="soft">
            Exemple                            </option>
        <option value="hard">
            Exemple                            </option>
    </select>
    <div>
</section>
<hr>
<section>
    <h1>alert</h1>
<div class="alert alert-danger m-auto mb-2" style="width: 80%">Attention !<br>Exemple message erreur.
</div>
</section>
<hr>
<br>
<section>
<table class="">
    <h1>table</h1>
    <thead>
    <tr>
        <th>Exemple</th>
        <th>Exemple</th>
        <th>Exemple</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Exemple</td>
        <td>Exemple</td>
        <td>Exemple</td>
    </tr>
    </tbody>
</table>
</section>