<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Devis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f8f8;
        }
        label {
            font-weight: bold;
        }
        .form-control {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-3">Formulaire de Demande de Devis</h2>
    
    <?php if (isset($_SESSION['errors'])){ ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($_SESSION['errors'] as $error){ ?>
                    <li><?= $error ?></li>
                <?php }; ?>
            </ul>
        </div>
    <?php unset($_SESSION['errors']); }; ?>

    <form action="../Controleur/Contoleurdevis.php" method="get">
        <div class="mb-3">
            <label for="dateDebut" class="form-label">Date de début de réservation:</label>
            <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
        </div>

        <div class="mb-3">
            <label for="dateFin" class="form-label">Date de fin de réservation:</label>
            <input type="date" class="form-control" id="dateFin" name="dateFin" required>
        </div>

        <div class="mb-3">
            <label for="adultes" class="form-label">Nombre d'adultes:</label>
            <input type="number" class="form-control" id="adultes" name="adultes" min="1" required>
        </div>

        <div class="mb-3">
            <label for="enfants" class="form-label">Nombre d'enfants:</label>
            <input type="number" class="form-control" id="enfants" name="enfants" min="0" required>
        </div>

        <div class="mb-3">
            <label for="typeChambre" class="form-label">Type de chambre:</label>
            <select id="typeChambre" name="typeChambre" class="form-select" required>
                <option value="Standard">Standard</option>
                <option value="Luxe">Luxe</option>
                 <option value="Suite">Suite</option>
               
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Obtenir un devis</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
