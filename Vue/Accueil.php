<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Rosa Beach Thalasso & Spa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <main class="container my-4">
        <section class="text-center">
            <h1 class="my-4">Rosa Beach Thalasso & Spa</h1>
            <img src="image/RosaBeach.jpg" alt="Rosa Beach" class="img-fluid rounded">
        </section>
        <section class="my-4">
            <p>
                Découvrez l'hôtel Rosa Beach Thalasso Monastir:
                Un Hôtel ultraconfortable 
                
            </p>
            <h2 class="my-3">Demander un devis</h2>
            <?php include 'formDevis.php'; ?>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
