<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            transition: all 0.3s;
            position: fixed;
            overflow-y: auto;
        }
        .sidebar-link {
            color: #ffffff;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background-color: #007bff;
            text-decoration: none;
        }
        #content {
            margin-left: 250px;
            padding: 20px;
        }
        iframe {
            width: 100%;
            height: 80vh;
            border: none;
        }
        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px 15px;
            background-color: #dc3545; 
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #c82333;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['userRole'] === 'administrateur'){ ?>
    <div id="sidebar">
        <h2 class="text-center">Dashboard</h2>
        <a href="Accueil.php" class="sidebar-link" >Accueil</a>
        <a href="#" class="sidebar-link" onclick="loadPage('ToutesLesReservations.php')">Gestion Tout les reservation</a>
        <a href="#" class="sidebar-link" onclick="loadPage('chambre.php')">Gestion des Chambres</a>
        <a href="#" class="sidebar-link" onclick="loadPage('tarif.php')">Gestion des Tarifs</a>
        <a href="../Controleur/deconnexion.php" class="logout-btn">Déconnexion</a> 
    </div>
    <div id="content">
        <iframe id="iframeContent" src=""></iframe>
    </div>

<?php }; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function loadPage(pageUrl) {
        var iframe = document.getElementById('iframeContent');
        iframe.src = pageUrl;
    }
</script>
</body>
</html>
