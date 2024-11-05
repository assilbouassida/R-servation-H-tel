<?php
include "../Modele/Tarif.php";
include "../Modele/Saison.php";
include "../Modele/TypeChambre.php"; 
include "../Modele/ConnexionBD.php"; 

session_start(); 

$action = $_POST['action'] ?? ''; 

switch ($action) {
    case 'addTarif':
        $saisonId = $_POST['saisonId'] ?? null;
        $typeChambreId = $_POST['typeChambreId'] ?? null;
        $prix = $_POST['prix'] ?? null;

        if ($saisonId && $typeChambreId && $prix) {
            $result = Tarif::ajouter($saisonId, $typeChambreId, $prix);
            if ($result) {
                header("Location: ../Vue/tarif.php?success=Le tarif a été ajouté avec succès");
                exit;
            } else {
                header("Location: ../Vue/tarif.php");
                exit;
            }
        } else {
            header("Location: ../Vue/tarif.php");
            exit;
        }
        break;

    case 'editTarif':
        $id = $_POST['id'] ?? null;
        $saisonId = $_POST['saisonId'] ?? null;
        $typeChambreId = $_POST['typeChambreId'] ?? null;
        $prix = $_POST['prix'] ?? null;

        if ($id && $saisonId && $typeChambreId && $prix) {
            $result = Tarif::modifier($id, $saisonId, $typeChambreId, $prix);
            if ($result) {
                header("Location: ../Vue/tarif.php?success=Le tarif a été modifié avec succès");
                exit;
            } else {
                header("Location: ../Vue/tarif.php");
                exit;
            }
        } else {
            header("Location: ../Vue/tarif.php");
            exit;
        }
        break;

    case 'deleteTarif':
        $id = $_POST['id'] ?? null;

        if ($id) {
            $result = Tarif::supp($id);
            if ($result) {
                header("Location: ../Vue/tarif.php?success=Le tarif a été supprimé avec succès");
                exit;
            } else {
                header("Location: ../Vue/tarif.php");
                exit;
            }
        } else {
            header("Location: ../Vue/tarif.php");
            exit;
        }
        break;

  
}

?>
