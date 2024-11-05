<?php
session_start();
include "../Modele/Saison.php";
include "../Modele/Tarif.php";
include "../Modele/TypeChambre.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $dateDebut = $_GET['dateDebut'] ?? null;
    $dateFin = $_GET['dateFin'] ?? null;
    $adultes = $_GET['adultes'] ?? null;
    $enfants = $_GET['enfants'] ?? null;
    $libTypeChambre = $_GET['typeChambre'] ?? null;

    if (!$dateDebut || !$dateFin || !$libTypeChambre) {
        $_SESSION['errors'] = ["Tous les champs sont nécessaires"];
        header('Location: ../Vue/Accueil.php');
        exit();
    }

    $dateDeb = new DateTime($dateDebut);
    $dateFinn = new DateTime($dateFin);
    $dateLyoum = new DateTime();
    
    if ($dateDeb < $dateLyoum) {
        $_SESSION['errors'] = ["La date de début petit a date actuelle"];
        header('Location: ../Vue/Accueil.php');
        exit();
    }

    if ($dateDeb >= $dateFinn) {
        $_SESSION['errors'] = ["La date de début grand a date de fin"];
        header('Location: ../Vue/Accueil.php');
        exit();
    }
    
    $devisInfo = calculateDevis($dateDebut, $dateFin, $adultes, $enfants, $libTypeChambre);

    if (!$devisInfo) {
        $_SESSION['errors'] = ["Impossible de calculer le devis avec les informations fournies."];
        header('Location: ../Vue/Accueil.php');
        exit();
    }
    $_SESSION['devisInfo'] = $devisInfo;
    header('Location: ../Vue/devis.php');
    exit();
}

function calculateDevis($dateDebut, $dateFin, $adultes, $enfants, $libTypeChambre) {
    $saison = Saison::findSeasonByDate($dateDebut);
    $typeChambre = TypeChambre::findByLibelle($libTypeChambre);
    $typeChambreId = $typeChambre->id;
    $tarif = Tarif::findBySeasonAndTypeChambre($saison->id, $typeChambreId);
    $dureeSejour = (new DateTime($dateDebut))->diff(new DateTime($dateFin))->days;
    $total = $tarif->prix * $dureeSejour;
    

    return [    
        'dateDebut' => $dateDebut,
        'dateFin' => $dateFin,
        'adultes' => $adultes,
        'enfants' => $enfants,
        'typeChambre' => $typeChambreId, 
        'prix' => $tarif->prix,
        'total' => $total,
    ];
}

?>
