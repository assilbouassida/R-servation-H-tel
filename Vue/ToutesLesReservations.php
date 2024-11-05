<?php
require_once "../Modele/Reservation.php";
require_once "../Modele/Chambre.php";

$date = date('Y-m-d');
$reservations = Reservation::termine($date);
foreach ($reservations as $reservation) {
    $reservation->etat = 2;
    $reservation->save();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les Réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            margin-right: 5px;
        }
        .btn-success, .btn-danger, .btn-primary {
            color: #fff;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-control-sm {
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Toutes les réservations</h1>
    <form method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recherche par id de reservation" name="search">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID Réservation</th>
                <th>ID Client</th>
                <th>Numéro de Chambre</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Nombre d'adultes</th>
                <th>Nombre d'enfants</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $reservations = isset($_GET['search']) ? Reservation::search($_GET['search']) : Reservation::findAll();
            foreach ($reservations as $reservation){
                $chambre = Chambre::findById($reservation->id_chambre);
                ?>
                <tr>
                    <td><?= $reservation->id_reservation ?></td>
                    <td><?= $reservation->id_client ?></td>
                    <td>
                    <form action='../Controleur/ControleurChambre.php' method='post' class="d-flex justify-content-center align-items-center">
    <input type='hidden' name='action' value='updateNumero'>
    <input type='hidden' name='id_chambre' value='<?= $chambre->id ?>'>
    <input type='text' name='nouveau_numero' value='<?= $chambre->numero ?>' class='form-control form-control-sm me-2' style='width: auto;'>
    <button type='submit' class='btn btn-primary btn-sm'>Modifier</button>
</form>
                    </td>
                    <td><?= $reservation->date_debut ?></td>
                    <td><?= $reservation->date_fin ?></td>
                    <td><?= $reservation->nb_adultes ?></td>
                    <td><?= $reservation->nb_enfants ?></td>
                    <td><?= etat($reservation->etat) ?></td>
                    <td>
                        <form action='../Controleur/ControleurReservation.php' method='post' style='display: inline;'>
                            <input type='hidden' name='action' value='valider'>
                            <input type='hidden' name='id_reservation' value='<?= $reservation->id_reservation ?>'>
                            <button type='submit' class='btn <?= $reservation->etat == 0 ? 'btn-danger' : 'btn-success' ?>'>Valider</button>
                        </form>
                        <form action='../Controleur/ControleurReservation.php' method='post' style='display: inline;'>
                            <input type='hidden' name='action' value='terminer'>
                            <input type='hidden' name='id_reservation' value='<?= $reservation->id_reservation ?>'>
                            <button type='submit' class='btn btn-secondary'>Terminer</button>
                        </form>
                    </td>
                </tr>
            <?php };

            function etat($etat) {  
                switch ($etat) {
                    case 0:
                        return 'En attente';
                    case 1:
                        return 'Validée';
                    case 2:
                        return 'Terminée';
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
