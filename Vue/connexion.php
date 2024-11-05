<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            background-color: #f4f4f4; 
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center; 
            justify-content: center;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            width: 100%;
            max-width: 400px; 
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <div class="form-container">
            <form action="../Controleur/ControleurConnecte.php" method="POST">
                <h2 class="mb-3 text-center">Se connecter</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
                <?php if (isset($_SESSION['error'])){ ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php }; ?>
                <a href="inscription.php" class="register-link">Pas encore inscrit ? Inscrivez-vous ici</a> 
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
