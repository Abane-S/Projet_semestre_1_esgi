<div class="div-form">
   <div class="d-flex justify-between mb-4 pt-2">
        <h1 class="fs-4 ">Creation de page</h1>
        <button type="button" class="button button-primary button-md">Voir la page</button>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" class="fs-2">
        <div class="d-flex justify-around gap-2">
            <div class="w-5">
                <label for="title" class="form-label d-block mb-1">Title la page</label>
                <input type="text" name="title" class="w-10 pt-1 border" id="title"  placeholder="Title de l'ongle de la page (important pour le SEO)" required="required">
            </div>
            <div class="w-5">
                <label for="meta-description" class="meta_description d-block mb-1">Meta Description</label>
                <input type="text" name="meta_description" class="w-10 pt-1 border" id="meta-description" placeholder="Description courte de la page (encore une fois important pour le SEO)" required="required">
            </div>
        </div>
        <div class="d-flex justify-around align-items-center gap-2 mt-3"> 
            <div class="w-5">
                <label for="titre" class="form-label d-block mb-1">Titre la page</label>
                <input type="text" name="titre" class="w-10 pt-1 border" id="titre" placeholder="Titre de la page cette fois-ci le titre h1 visible sur la page" required="required">
            </div>
            <div class="w-5">
                <label for="bannière" class="d-block mb-1">Choisir une banière</label>
                <input type="file" class="" name="files" id="bannière" placeholder="Choisir un fichier" required="required">
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 mt-3 mb-10"> 
            <div class="w-5">
                <label for="title" class="form-label d-block mb-1">Selectionner un article comme contenu principal</label>
                <select name="article" class="w-10 p-1-1">
                    <option value="-1" selected="true">Aucun article selectionner</option>
                    <?php foreach($articles as $article): ?>
                        <option value="<?=$article['id']?>"><?=$article['titre']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="page-content mt-7 ">
            <textarea id="editor" name="content">
                Contenu de votre page
            </textarea>
        </div>

        <div class="d-flex justify-end mt-5">
            <input type="submit" name="submit" id="submit_btn" class="button button-primary button-md" value="Enregistrer">
        </div>

    </form>
</div>
