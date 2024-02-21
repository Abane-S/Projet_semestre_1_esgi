document.addEventListener('DOMContentLoaded', function() {
    var labelElement = document.getElementById('menu_icon_label');
    var labelContent = labelElement ? labelElement.textContent : '';
    var selectElement = document.getElementById('menu_icon_select');

    // Vérification si labelElement et selectElement existent avant de modifier le contenu de labelElement
    if (labelElement && selectElement) {
        var selectedOption = selectElement.value;
        labelElement.innerHTML = labelContent + "<i class='" + selectedOption + "'></i>";

        // Ajout de l'écouteur d'événement seulement si selectElement existe
        selectElement.addEventListener('change', function() {
            var selectedOption = this.value;
            labelElement.innerHTML = labelContent + "<i class='" + selectedOption + "'></i>";
        });
    }
});
