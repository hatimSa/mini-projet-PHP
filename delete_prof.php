<?php
include 'config.php';

// Vérifie si l'ID du professeur est fourni dans l'URL
if (isset($_GET['id'])) {
    $profId = $_GET['id'];

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prépare la requête de suppression
        $stmt = $conn->prepare("DELETE FROM Prof WHERE prof_id = :profId");
        $stmt->bindParam(':profId', $profId);
        $stmt->execute();

        $stmt2 = $conn->prepare("DELETE FROM users WHERE user_id = :profId");
        $stmt2->bindParam(':profId', $profId);
        $stmt2->execute();

        // Redirection vers la liste des professeurs avec un message de succès
        header("Location: prof_list.php?success=1");
        exit();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
        exit();
    }
} else {
    // Si l'ID du professeur n'est pas fourni dans l'URL, redirigez vers la liste des professeurs
    header("Location: prof_list.php");
    exit();
}
