<?php
session_start();
include "../Modele/ConnexionBD.php";
include "../Modele/Saison.php";
include "../Modele/Tarif.php";
include "../Modele/TypeChambre.php";

class ControleurFormDevis {
    public function form() {
        session_start();

        include_once "../Vue/formDevis.php";

        unset($_SESSION['errors']);
    }

    public function formm() {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $errors = $this->validateForm($_POST);

            if (empty($errors)) {
                
                header('Location: Contoleurdevis.php');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                
                header('Location: ControleurFormDevis.php');
                exit();
            }
        }
    }

    private function validateForm($formData) {
        $errors = [];

        if (empty($formData['dateDebut'])) {
            $errors[] = "La date de début est requise.";
        } elseif (strtotime($formData['dateDebut']) < strtotime(date('Y-m-d'))) {
            $errors[] = "La date de début doit être aujourd'hui ou dans le futur.";
        }
        if (empty($formData['dateFin'])) {
            $errors[] = "La date de fin est requise.";
        } elseif (strtotime($formData['dateFin']) < strtotime($formData['dateDebut'])) {
            $errors[] = "La date de fin doit être postérieure à la date de début.";
        }

        return $errors;
    }
}


$controller = new ControleurFormDevis();
$controller->formm();
$controller->form();
?>
