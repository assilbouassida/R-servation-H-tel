<?php 
include "../Modele/Chambre.php";
include "../Modele/ConnexionBD.php";

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');
$id = isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : null);
$typeChambreId = isset($_POST['type_chambre']) ? $_POST['type_chambre'] : null;
$numero = isset($_POST['numero']) ? $_POST['numero'] : null;
$statut = isset($_POST['statut']) ? $_POST['statut'] : 'disponible'; 



switch ($action) {
    case 'add':
        if ($typeChambreId !== null && $numero !== null) {
            Chambre::ajouter($typeChambreId, $numero, $statut);
            header("Location: ../Vue/chambre.php?success=Ajout réussi");
        } else {
            header("Location: ../Vue/chambre.php?error=Échec de l'ajout");
        }
        break;

    case 'edit':
        if ($id !== null && $numero !== null && $typeChambreId !== null) {
            Chambre::modifier($id, $typeChambreId, $numero, $statut);
            header("Location: ../Vue/chambre.php?success=Modification réussie");
        } else {
            header("Location: ../Vue/chambre.php?error=Échec de la modification");
        }
        break;

       

    case 'delete':
        if ($id !== null) {
            Chambre::supp($id);
            header("Location: ../Vue/chambre.php?success=Suppression réussie");
        } else {
            header("Location: ../Vue/chambre.php?error=Échec de la suppression");
        }
        break;

    default:
        header("Location: ../Vue/chambre.php?error=Action non reconnue");
        break;
}

exit();
?>
