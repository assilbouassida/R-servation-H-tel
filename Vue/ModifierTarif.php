<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier tarif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <?php
    require_once "../Modele/Saison.php";
    require_once "../Modele/TypeChambre.php";
    require_once "../Modele/Tarif.php";

    $id = $_GET['id'] ?? null;
    if (!$id) {
        
        header("Location: tarif.php?error=Aucun ID de tarif fourni pour la modification");
        exit;
    }

    $tarif = Tarif::findById($id); 
    if (!$tarif) {
        
        header("Location: tarif.php?error=Le tarif demandé n'est pas trouvé");
        exit;
    }
    $saisons = Saison::findAll();
    $typesChambres = TypeChambre::findAll();
    ?>

    <h1>Modifier le Tarif</h1>

    <form method="post" action="../Controleur/ControleurTarif.php">
        <input type="hidden" name="action" value="editTarif">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mb-3">
            <label for="saison" class="form-label">Saison</label>
            <select class="form-select" id="saison" name="saisonId" required>
                <?php foreach ($saisons as $saison) {
                    $selected = ($saison['id_sai'] == $tarif->saisonId) ? 'selected' : '';
                    echo "<option value='" . $saison['id_sai'] . "' $selected>" .$saison['libelle_sai'] . "</option>";
                } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="typeChambre" class="form-label">Type de Chambre</label>
            <select class="form-select" id="typeChambre" name="typeChambreId">
                <?php foreach ($typesChambres as $typeChambre) {
                    $selected = ($typeChambre['id_type_ch'] == $tarif->typeChambreId) ? 'selected' : '';
                    echo "<option value='" . $typeChambre['id_type_ch']. "' $selected>" . $typeChambre['libelle_type_ch'] . "</option>";
                } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" value="<?php echo $tarif->prix; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
