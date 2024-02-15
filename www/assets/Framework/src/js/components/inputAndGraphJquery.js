import $ from 'jquery';

$(document).ready(function() {
    // Écoute l'événement de changement sur le menu déroulant
    $('select[name="article"]').change(function() {
        // Vérifie si l'article sélectionné est différent de "-1"
        if ($(this).val() !== "-1") {
            // Cache la div contenant l'éditeur
            $('.page-content').hide();
        } else {
            // Affiche la div contenant l'éditeur
            $('.page-content').show();
        }
    });
});