<?php

session_start();
$_SESSION = array();
session_destroy();
header("Location: ../Vue/connexion.php");
exit;
?>
