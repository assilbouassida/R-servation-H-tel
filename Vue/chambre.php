<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Chambres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Gestion des Chambres</h1>

        <h2>Ajouter une chambre</h2>
        <form method="post" action="../Controleur/ControleurChambre.php">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="numero" class="form-label">Numéro de chambre</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="typeChambre" class="form-label">Type de chambre</label>
                <select class="form-select" id="typeChambre" name="type_chambre">
                    <?php
                    
                    include "../Modele/TypeChambre.php";
                    $typesChambres = TypeChambre::findAll();
                    foreach ($typesChambres as $typeChambre) {
                        echo "<option value='" . $typeChambre['id_type_ch'] . "'>" . $typeChambre['libelle_type_ch'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <hr>
        <form method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recherche par numero chambre" name="search">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
        </div>
    </form>
        <h2>Liste des Chambres</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Chambre</th>
                    <th>Type de chambre</th>
                    <th>Numéro de chambre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../Modele/Chambre.php";
                include "../Modele/TypeChambre.php";
                
                $chambres = isset($_GET['search']) ? Chambre::search($_GET['search']) : Chambre::findAll();
                
                foreach ($chambres as $chambre) {
                    $typeChambre = TypeChambre::findById($chambre['id_type_ch']);
                    ?>
                    <tr>
                    <td>  <?php echo $chambre['id_chambre'] ?></td> 
                    <td> <?php echo $typeChambre->libelle ?></td>
                    <td> <?php echo $chambre['num_chambre'] ?></td>
                    <td> <?php echo $chambre['statut'] ?></td>
                    <td>
                    <a href='ModifierChambre.php?id=<?php echo $chambre['id_chambre']; ?>' class='btn btn-success'>Modifier</a>
                    <a href='../Controleur/ControleurChambre.php?action=delete&id=<?php echo $chambre['id_chambre']; ?>' class='btn btn-danger'>Supprimer</a>
                    </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
