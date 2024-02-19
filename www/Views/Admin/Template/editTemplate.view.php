<div class="divform ml-auto mr-auto center-form">
    <h1>Modifier un template</h1><br><br>
    <?php

        if (isset($errors) && !empty($errors)) {
            echo "<div class='alert alert-danger' style='width: 80%;margin: auto;'>";
            foreach ($errors as $error) {
                echo "<p>" . $error . "</p>";
            }
            echo "</div>";
        }
    ?>
    <?php $this->includeComponent("form", $config);?>
</div>

<?php
if (isset($modal)) {
    $this->includeComponent("modal", $modal);
}
?>

<div id = "preview_template">
    <?php

    function CompareURI($uriToCheck): bool
    {
        $uri = strtolower($_SERVER["REQUEST_URI"]);
        $uri = strtok($uri, "?");
        $uri = strlen($uri) > 1 ? rtrim($uri, "/") : $uri;

        return $uriToCheck == $uri;
    }

    ?>

<hr>
    <br>
    <h1 class="text-center">Préview du template :</h1><br>
        <header id="header-preview" class="esgi-header">
            <div class="container">
                <a href="/" class="esgi-logo">

                    <img style="width: 7rem;
    height: 7rem;" src=<?=  defined('SITE_LOGO') ? SITE_LOGO : "../../assets/Framework/public/images/logo_djimido_website.png" ?> alt="Logo site"/>
                </a>
                <nav>
                    <div style="display: flex;
    margin-right: 25px;">
                        <i class="ri-dashboard-line"></i><p id="menus-preview">Exemple</p>
                    </div>
                </nav>
            </div>
        </header>
    <main>
       <div id="background-preview">
           <br>
           <h1 class="text-center">Exemple Titre</h1>
           <br>
           Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ac turpis egestas integer eget aliquet nibh. Leo a diam sollicitudin tempor id eu nisl nunc. Elit ut aliquam purus sit amet luctus venenatis lectus magna. Consectetur adipiscing elit ut aliquam purus sit amet luctus. Ornare suspendisse sed nisi lacus sed. Elit at imperdiet dui accumsan sit amet. Ultricies integer quis auctor elit sed vulputate mi. Dignissim sodales ut eu sem integer vitae justo. Commodo quis imperdiet massa tincidunt.
       </div>
    </main>
</div>
