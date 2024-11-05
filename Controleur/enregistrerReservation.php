<?php
session_start();
include '../Modele/ConnexionBD.php';
include '../Modele/Reservation.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../Vue/connexion.php');
    exit;
}

$con = ConnexionBD::getInstance();

$dateDebut = $_SESSION['devisInfo']['dateDebut'];
$dateFin = $_SESSION['devisInfo']['dateFin'];
$adultes = $_SESSION['devisInfo']['adultes'];
$enfants = $_SESSION['devisInfo']['enfants'];
$typeChambre = $_SESSION['devisInfo']['typeChambre'];

$idClient = $_SESSION['userID'];


$stmt = $con->prepare("INSERT INTO reservation (id_client, id_chambre, date_debut, date_fin, nb_adultes, nb_enfants, etat) 
VALUES (:idClient, :idChambre, :dateDebut, :dateFin, :adultes, :enfants, 0)");


$stmt->bindParam(':idClient', $idClient);
$stmt->bindParam(':idChambre', $typeChambre);
$stmt->bindParam(':dateDebut', $dateDebut);
$stmt->bindParam(':dateFin', $dateFin);
$stmt->bindParam(':adultes', $adultes);
$stmt->bindParam(':enfants', $enfants);

$stmt->execute();

header('Location: ControleurlisteReservation.php');
exit;
?>
