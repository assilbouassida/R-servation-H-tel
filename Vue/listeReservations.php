<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <h1>Liste de vos réservations</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Réservation</th>
                    <th>ID Chambre</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Nombre d'adultes</th>
                    <th>Nombre d'enfants</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($reservations) && !empty($reservations)){
                     ?>
                    <?php foreach ($reservations as $reservation){?>
                        <tr>
                            <td><?= $reservation->id_reservation ?></td>
                            <td><?= $reservation->id_chambre?></td>
                            <td><?= $reservation->date_debut ?></td>
                            <td><?= $reservation->date_fin?></td>
                            <td><?= $reservation->nb_adultes ?></td>
                            <td><?= $reservation->nb_enfants ?></td>
                            <td> <?php 
                        switch ($reservation->etat) {
                            case 0:
                                echo 'En attente';
                                break;
                            case 1:
                                echo 'Validée';
                                break;
                            case 2:
                                echo 'Terminée';
                                break;
                        
                        }
                        ?> </td>
                        </tr>
                    <?php }; ?>
               
                <?php }; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
