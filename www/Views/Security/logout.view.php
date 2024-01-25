<div class="div_input">
    <h2>Déconnexion.</h2>

    <span>Vous avez été déconnecté.<br>Vous allez être redirigé vers la page de connexion.</span>
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
