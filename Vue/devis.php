<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Devis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px;
             margin-top: 20px; 
             padding: 20px; 
             border-radius: 5px; 
             background-color: #f7f7f7; }
    </style>
</head>
<body>

<?php include 'nav.php';    ?>

<div class="container">
    <h2 class="mb-4">Détails de votre devis</h2>
    <?php if (isset($_SESSION['devisInfo'])){ ?>
      
        <p>Date de début: <?= $_SESSION['devisInfo']['dateDebut']; ?></p>
            <p>Date de fin: <?= $_SESSION['devisInfo']['dateFin']; ?></p>
            <p>Nombre d'adultes: <?= $_SESSION['devisInfo']['adultes']; ?></p>
            <p>Nombre d'enfants: <?= $_SESSION['devisInfo']['enfants']; ?></p>
            <p>Type de chambre: <?= $_SESSION['devisInfo']['typeChambre']; ?></p>
            <p>Prix total: <?= $_SESSION['devisInfo']['total']; ?> </p>
    <?php }; ?>
    <a href="Accueil.php" class="btn btn-warning">Annuler</a>

        <button class="btn btn-success" onclick="verifierConnexionEtReserver()">Réserver</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function verifierConnexionEtReserver() {
        if (confirm("Êtes-vous sûr de vouloir effectuer cette réservation ?")) {
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                window.location.href = '../Controleur/enregistrerReservation.php'; 
            <?php else: ?>
                window.location.href = 'connexion.php?redirect=devis.php';
            <?php endif; ?>
        }
    }
</script>

</body>
</html>
