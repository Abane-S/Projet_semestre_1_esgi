<div class="div-form ">
    <div class="d-flex justify-between mb-4 pt-2">
        <h1 class="fs-4 ">Creation de page</h1>
        <button type="button" class="button button-primary button-md">Voir la page</button>
    </div>
    <div class="fs-2">
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
                <label for="undefined" class="d-block mb-1">Choose a file </label>
                <input type="file" class="" name="undefined custom-file-upload" id="undefined" placeholder="Choisir un fichier">
            </div>
            <div class="w-5">
                <div class="d-flex align-items-center gap-1 form-check form-switch">
                    <input type="checkbox" class="form-check-input" role="switch" id="is_commentable">
                    <label for="is_commentable" class="form-check-label">Commentaires</label>
                </div>
            </div>
        </div>
        <div class="page-content mt-7 " style="height:1500px">
            <textarea name="content" id="editor" class="w-10 border" rows="50" cols="33" placeholder="Contenu de la page"></textarea>
        </div>

        <div class="d-flex justify-end mt-5">
            <button type="submit" class="button button-primary button-md">Enregistrer</button>
        </div>

    </div>
</div>