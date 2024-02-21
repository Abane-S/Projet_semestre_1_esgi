

$(document).ready(function() {
  // Écoute l'événement de changement sur le menu déroulant
  $('select[name="article"]').change(function() {
    if ($(this).val() !== "-1") {
      // Cache la div contenant l'éditeur
      $('.page-content').hide();
    } else {
      // Affiche la div contenant l'éditeur
      $('.page-content').show();
    }
  });

  // Préparation du contexte pour le graphique de trafic
  var ctx = $('#peopleVisitedSite').get(0).getContext('2d');
  var traficGraphique = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Janvier', 'Février', 'Mars', 'Avril'], // Labels des axes
      datasets: [{
        label: 'Visites', // Légende
        data: [10, 20, 30, 40], // Données
      }]
    },
    options: {} // Options du graphique
  });

  var ctt = $('#articles').get(0).getContext('2d');
  var traficGraphique = new Chart(ctt, {
    type: 'bar',
    data: {
      labels: ['Janvier', 'Février', 'Mars', 'Avril'], // Labels des axes
      datasets: [{
        label: 'Visites', // Légende
        data: [10, 20, 30, 40], // Données
      }]
    },
    options: {} // Options du graphique
  });


  var ctl = $('#comments').get(0).getContext('2d');
  var traficGraphique = new Chart(ctl, {
    type: 'bar',
    data: {
      labels: ['Janvier', 'Février', 'Mars', 'Avril'], // Labels des axes
      datasets: [{
        label: 'Visites', // Légende
        data: [10, 20, 30, 40], // Données
      }]
    },
    options: {} // Options du graphique
  });
});