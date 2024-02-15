

<!DOCTYPE html>
<html lang="fr">
    <body>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?=  defined('SITE_NAME') ? SITE_NAME : "" ?></title>
            <link rel="apple-touch-icon" sizes="180x180" href="../../assets/Framework/public/images/favicon_djimdo.png">
            <link rel="stylesheet" href="../../assets/Framework/src/style.css">
            <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
            <script type="module" src="/assets/Framework/src/dist/js/main_vite.js"></script>
        </head>
        <main>
            <?php include $this->viewName; ?>
        </main>
    </body>
</html>