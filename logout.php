<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = array();

// Détruire complètement la session
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit;
