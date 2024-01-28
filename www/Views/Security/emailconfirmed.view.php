<div class="divform ml-auto mr-auto center-form">
    <h2>Email confirmer</h2>

    <span>Votre adresse e-mail a bien été confirmée, votre compte est maintenant activé.<br>Vous allez être redirigé vers la page de connexion</span>
    <div class="loader-dot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>

<script>
    // Attendre 5 secondes (5000 millisecondes) avant de rediriger vers /login
    setTimeout(function() {
        window.location.href = '/login';
    }, 3500);

</script>
