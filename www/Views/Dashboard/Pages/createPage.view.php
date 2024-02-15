<div class="div-form">
   <div class="d-flex justify-between mb-4 pt-2">
        <h1 class="fs-4 ">Creation de page</h1>
        <button type="button" class="button button-primary button-md">Voir la page</button>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" class="fs-2">
        <div class="d-flex justify-around gap-2">
            <div class="w-5">
                <label for="title" class="form-label d-block mb-1">Title la page</label>
                <input type="text" name="title" class="w-10 pt-1 border" id="title"  placeholder="Title de l'ongle de la page (important pour le SEO)" required="required" value="<?= $page['title']?? "" ?>">
            </div>
            <div class="w-5">
                <label for="meta-description" class="meta_description d-block mb-1">Meta Description</label>
                <input type="text" name="meta_description" class="w-10 pt-1 border" id="meta-description" value="<?= $page['meta_description']?? "" ?>" placeholder="Description courte de la page (encore une fois important pour le SEO)" required="required">
            </div>
        </div>
        <div class="d-flex justify-around align-items-center gap-2 mt-3"> 
            <div class="w-5">
                <label for="titre" class="form-label d-block mb-1">Titre la page</label>
                <input type="text" name="titre" class="w-10 pt-1 border" id="titre" placeholder="Titre de la page cette fois-ci le titre h1 visible sur la page" required="required" value="<?= $page['titre']?? "" ?>">
            </div>
            <div class="w-5">
                <label for="Menu" class="d-block mb-1">Le nom de votre menu sur la navbar</label>
                <input type="text" name="menu" class="w-10 pt-1 border" id="menu" placeholder="Nom de votre item sur la navbar" required="required" value="<?= $page['menu']?? "" ?>">
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 mt-3 mb-10"> 
            <div class="w-5">
                <label for="title" class="form-label d-block mb-1">Selectionner un article comme contenu principal</label>
                <select name="article" class="w-10 p-1-1">
                    <option value="-1" selected="true">Aucun article selectionner</option>
                    <?php foreach($articles as $article): ?>
                        <option value="<?=$article['id']?>"><?=$article['titre']  ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-5">
                <label for="images" class="d-block mb-1">Choisir une banière</label>
                <input type="file" class="banniere" name="images" id="images" placeholder="Choisir un fichier" required="required">
            </div>            
        </div>
        <div class="page-content mt-7 ">
            <textarea id="editor" name="content" ">
                <?= $page['content']?? "Contenu de votre page" ?>
            </textarea>
        </div>
        
        <div>
            <label for="crsf_token"></label>
            <input type="hidden" name="csrf_token" value="<?php echo GenerateCSRFToken() ?>">
        </div>
        <div class="d-flex justify-end mt-5">
            <input type="submit" name="submit" id="submit_btn" class="button button-primary button-md" value="Enregistrer">
        </div>

    </form>
</div>


<?php
// Function to generate CSRF token
function GenerateCSRFToken()
{
    if (!isset($_SESSION['csrf_token']) || empty($_SESSION['csrf_token'])) {
        // Generate a random string for the CSRF token
        $token = bin2hex(random_bytes(32));

        // Store the token in the session for verification
        $_SESSION['csrf_token'] = $token;
    } else {
        // Retrieve the existing CSRF token from the session
        $token = $_SESSION['csrf_token'];

    }
    return $token;
}


if (isset($modal)) {
    $this->includeComponent("modal", $modal);
}