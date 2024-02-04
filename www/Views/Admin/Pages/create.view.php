<div class="div-form ">
    <div class="d-flex justify-between mb-4 pt-2">
        <h1 class="fs-4 ">Creation de page</h1>
        <button type="button" class="button button-primary button-md">Voir la page</button>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" class="fs-2">
        <div class="d-flex justify-around gap-2">
            <div class="w-5">
                <label for="title" class="form-label d-block mb-1">Titre de la page</label>
                <input type="text" name="title" class="w-10 pt-1 border" id="title" placeholder="Titre de la page">
            </div>
            <div class="w-5">
                <label for="meta-description" class="meta_description d-block mb-1">Meta description</label>
                <input type="text" name="meta_description" class="w-10 pt-1 border" id="meta_description" placeholder="Meta description">
            </div>
        </div>
        <div class="d-flex justify-around align-items-center gap-2 mt-3"> 
            <div class="w-5">
                <label for="undefined" class="d-block mb-1">Choisir une miniature </label>
                <input type="file" class="" name="files" id="undefined" placeholder="Choisir un fichier">
            </div>
            <div class="w-5">
                <div class="d-flex align-items-center gap-1 form-check form-switch">
                    <input type="checkbox" name="comments" class="form-check-input" role="switch" id="is_commentable">
                    <label for="is_commentable" class="form-check-label">Commentaires</label>
                </div>
            </div>
        </div>
        <div class="page-content mt-7 ">
            <div id="editor">This is some sample content.</div>
        </div>

        <div class="d-flex justify-end mt-5">
            <input type="submit" name="submit" class="button button-primary button-md" value="Enregistrer">
        </div>

    </form>
    <footer>
        <script src="../../node_modules/@ckeditpr/keditor5-build-classic/build/ckeditor.js"></script>
        <script type="module" src="../../assets/Framework/src/js/main.js"></script>
    </footer>
</div>