<?php
session_start();
include "../Modele/ConnexionBD.php";
include "../Modele/Utilisateur.php";

$con = ConnexionBD::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $stmt = $con->prepare("SELECT * FROM Utilisateur WHERE email = ? AND mot_de_passe = ?");
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['loggedin'] = true;
        $_SESSION['userID'] = $userData['id_utilisateur'];
        $_SESSION['username'] = $userData['nom'];
        $_SESSION['userRole'] = $userData['role'];
        $_SESSION['userImage'] = $userData['image']; 

        if (isset($_GET['redirect'])) {
            header("Location: ../Vue/".$_GET['redirect']);
        } else {
            header("Location: ../Vue/Accueil.php");
        }
        exit;
    } else {
        $_SESSION['error'] = "Identifiants incorrects";
        header("Location: ../Vue/connexion.php");
        exit;
    }
}
?>
