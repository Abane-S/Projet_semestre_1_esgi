<div class="div_input">
    <h2>Email confirmer</h2>

    <span>Votre adresse e-mail a bien été confirmée, votre compte est maintenant activé.<br>Vous allez être redirigé vers la page de connexion</span>
    <img class="mt-2" style="width: 5%;" src="assets/Images/loader.gif" alt="Loader">
</div>

<script>
    // Attendre 5 secondes (5000 millisecondes) avant de rediriger vers /login
    setTimeout(function() {
        window.location.href = '/login';
    }, 3500);

</script>
