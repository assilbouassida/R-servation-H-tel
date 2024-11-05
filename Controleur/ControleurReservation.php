<?php
include "../Modele/Reservation.php";
include "../Modele/Chambre.php";




function validerReservation($id_reservation) {
    $reservation = Reservation::findById($id_reservation);
    if ($reservation && $reservation->etat == 0) { 
        $reservation->etat = 1; 
        $reservation->save(); 
    }
}

function terminerReservation($id_reservation) {
    $reservation = Reservation::findById($id_reservation);
    if ($reservation && $reservation->etat == 1) { 
        $reservation->etat = 2;
        $reservation->save(); 
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['id_reservation'])) {
        switch ($_POST['action']) {
            case 'valider':
                validerReservation($_POST['id_reservation']);
                break;
            case 'terminer':
                terminerReservation($_POST['id_reservation']);
                break;
        }
    }
    header("Location: ../Vue/ToutesLesReservations.php");
    exit;
}

?>
