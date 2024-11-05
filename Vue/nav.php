<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #343a40; 
            border-bottom: 3px solid #ffc107; 
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
            font-weight: bold;
        }
        .nav-link:hover {
            color: #ffc107 !important; 
        }
        .navbar-toggler {
            border-color: #ffc107;
        }
        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="Accueil.php">Hotel-AB</a>
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="../Vue/Accueil.php">Accueil</a>
                </li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <li class="nav-item">
                        <?php if (!empty($_SESSION['userImage'])){ ?>
                            <img src="<?php echo htmlspecialchars($_SESSION['userImage']); ?>" alt="Profile Image" class="profile-image">
                        <?php }; ?>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </li>
                    <?php if ($_SESSION['userRole'] === 'client'){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../Controleur/ControleurlisteReservation.php">Réservations</a>
                        </li>
                    <?php }; ?>
                    <?php if ($_SESSION['userRole'] === 'administrateur'){?>
                        <li class="nav-item">
                            <a class="nav-link" href="../Vue/dashboard.php">Dashboard</a>
                        </li>
                    <?php }; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controleur/deconnexion.php">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>