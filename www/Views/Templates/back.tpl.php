<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Back</title>
</head>
<body>
    <h1>Template Back</h1>

    <?//php include $this->viewName;?>
    
</body>
</html> -->



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog ESGI</title>
    <meta name="description" content="ceci est un super site">
    <link href="../public/DataTables/datatables.min.css" rel="stylesheet"/>
    <script src="../public/DataTables/datatables.min.js"></script>
    <script src="../public/js/jquery-3.5.1.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- CSS de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        
        .dashboard {
            min-height: 100%;
        }
        
        .dashboard-sidebar {
            background-color: #000;
            color: #fff;
        }
        
        .dashboard-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard d-flex">
        <!-- Dashboard latéral -->
        <div class="col-md-3 dashboard-sidebar bg-dark text-light">
            <h1>Dashboard</h1>
            <ul class="nav flex-column">

                <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-home"></i> Home
                </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users">
                        <i class="fas fa-users"></i> Gérer les utilisateurs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/articles">
                        <i class="fas fa-newspaper"></i> Gérer les articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages">
                        <i class="fas fa-file"></i> Gérer les pages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comments">
                        <i class="fas fa-comments"></i> Gérer les commentaires
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Contenu principal -->
        <div class="dashboard-content col-md-9">
            <!--<h1>Template Back</h1>-->
        
            <!-- inclure la vue -->
            <?php include $this->viewName;?>
        </div>
    </div>
    
    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>