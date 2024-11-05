<?php
session_start();
include '../Modele/ConnexionBD.php';
include '../Modele/Reservation.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: connexion.php');
    exit;
}

$con = ConnexionBD::getInstance();


$stmt = $con->prepare("SELECT * FROM reservation WHERE id_client = :clientId");
if (empty($_SESSION['userID'])) {
    die("L'identifiant de l'utilisateur est manquant ou invalide."); 
}

$stmt->bindParam(':clientId', $_SESSION['userID']);
$stmt->execute();

$reservations = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $reservations[] = new Reservation(
        $row['id_reservation'],
        $row['id_client'],
        $row['id_chambre'],
        $row['date_debut'],
        $row['date_fin'],
        $row['nb_adultes'],
        $row['nb_enfants'],
        $row['etat']
    );
}
if (empty($reservations)) {
    echo "Aucune réservation trouvée pour l'utilisateur avec l'ID: " . $_SESSION['userID']; 
} else {
    include '../Vue/listeReservations.php';
}
?>
