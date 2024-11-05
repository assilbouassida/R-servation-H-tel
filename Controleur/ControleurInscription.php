<?php
session_start();
include "../Modele/ConnexionBD.php"; 
include "../Modele/Utilisateur.php";

$con = ConnexionBD::getInstance();

if (isset($_POST['nom'], $_POST['email'], $_POST['password'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 
    $imagePath = null; 
    
    //image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDirectory = "../Vue/image/";
        $imagePath = $targetDirectory . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $_SESSION['inscription_error'] = "Erreur de téléchargement de l'image.";
            header("Location: ../Vue/inscription.php");
            exit;
        }
    }

    
    $sql = "INSERT INTO Utilisateur (nom, email, mot_de_passe, role, image) VALUES (?, ?, ?, 'client', ?)";
    $stmt = $con->prepare($sql);
    $success = $stmt->execute([$nom, $email, $password, $imagePath]);

    if ($success) {
        $_SESSION['inscription_message'] = "Inscription réussie! Vous pouvez maintenant vous connecter.";
        header("Location: ../Vue/connexion.php");
        exit;
    } else {
        $_SESSION['inscription_error'] = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
        header("Location: ../Vue/inscription.php");
        exit;
    }
} else {
    $_SESSION['inscription_error'] = "Toutes les informations requises ne sont pas fournies. Veuillez remplir tous les champs.";
    header("Location: ../Vue/inscription.php");
    exit;
}
?>
