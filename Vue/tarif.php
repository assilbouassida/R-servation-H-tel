<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tarifs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestion des Tarifs</h1>

        <?php
        require_once "../Modele/Saison.php";
        require_once "../Modele/TypeChambre.php";
        require_once "../Modele/Tarif.php";
        $saisons = Saison::findAll();
        $typesChambres = TypeChambre::findAll();
        $tarifs = Tarif::findAll();
        ?>

        <h2>Ajouter un tarif</h2>
        <form method="post" action="../Controleur/ControleurTarif.php">
            <input type="hidden" name="action" value="addTarif">
            <div class="mb-3">
                <label for="saison" class="form-label">Saison</label>
                <select class="form-select" id="saison" name="saisonId">
                    <?php foreach ($saisons as $saison) {
                        echo "<option value='" . $saison['id_sai']. "'>" . $saison['libelle_sai'] . "</option>";
                    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="typeChambre" class="form-label">Type de Chambre</label>
                <select class="form-select" id="typeChambre" name="typeChambreId">
                    <?php foreach ($typesChambres as $typeChambre) {
                        echo "<option value='" . $typeChambre['id_type_ch'] . "'>" . $typeChambre['libelle_type_ch']. "</option>";
                    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <hr>
        <h2>Liste des Tarifs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>id Tarif</th>
                    <th>Saison</th>
                    <th>Type de Chambre</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarifs as $tarif){?>
                    <tr>
                        <?php
                        $Saison = Saison::findById($tarif['id_sai']);
                        $typeChambre = TypeChambre::findById($tarif['id_type_ch']);
                        if ($typeChambre && $Saison){ ?>
                            <td><?php echo $tarif['id_tarif']; ?></td>
                            <td><?php echo $Saison->libelle; ?></td>
                            <td><?php echo $typeChambre->libelle; ?></td>
                            <td><?php echo $tarif['prix']; ?></td>
                            <td>
                                <a href='ModifierTarif.php?id=<?php echo $tarif['id_tarif']; ?>' class='btn btn-success'>Modifier</a>
                                <form action="../Controleur/ControleurTarif.php" method="post" style="display: inline;">
                                    <input type="hidden" name="action" value="deleteTarif">
                                    <input type="hidden" name="id" value="<?php echo $tarif['id_tarif']; ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        <?php }; ?>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
