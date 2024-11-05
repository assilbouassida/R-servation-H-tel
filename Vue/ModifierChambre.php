<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Chambre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Modifier la Chambre</h1>
        <?php
        require_once "../Modele/Chambre.php";
        require_once "../Modele/TypeChambre.php";

        $id = $_GET['id'] ?? null;
        if ($id) {
            $chambre = Chambre::findById($id);
            $typesChambres = TypeChambre::findAll();
        } else {
           
            header("Location: chambre.php");
            exit;
        }
        ?>

        <form method="post" action="../Controleur/ControleurChambre.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label for="numero" class="form-label">Numéro de chambre</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $chambre->numero; ?>" required>
            </div>

            <div class="mb-3">
                <label for="typeChambre" class="form-label">Type de chambre</label>
                <select class="form-select" id="typeChambre" name="type_chambre">
                    <?php
                    foreach ($typesChambres as $type) {
                        $selected = $chambre->typeChambreId == $type['id_type_ch'] ? 'selected' : '';
                        echo "<option value='" . $type['id_type_ch'] . "' $selected>" .$type['libelle_type_ch']. "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select" id="statut" name="statut">
                    <option value="disponible" <?php echo ($chambre->statut == 'disponible') ? 'selected' : ''; ?>>Disponible</option>
                    <option value="occupee" <?php echo ($chambre->statut == 'occupee') ? 'selected' : ''; ?>>Occupée</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
