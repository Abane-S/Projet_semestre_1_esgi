/* script button redirection page creation */

// document.addEventListener("DOMContentLoaded", function() {
//     // Sélectionnez le bouton par son ID
//     var createButton = document.getElementById("pageCreation");


//     // Écoutez le clic sur le bouton
//     createButton.addEventListener("click", function() {
//         // Modifiez l'URL en ajoutant "/create" à la fin
//         // Ceci changera l'URL sans recharger la page
//         window.history.pushState({}, "", "/dashboard/pages/create");
//     });
// });


function redirectOn(page) {
    window.location.href = "dashboard/" + page; // Ajoutez '/' pour spécifier le chemin complet
}

console.log("test");