<?php

session_start();

include 'config.php';
include('prof_template.php');

// Check if seance_id is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $seance_id = $_GET['id'];

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete the seance from the database
        $delete_stmt = $conn->prepare("DELETE FROM seance WHERE seance_id = :seance_id");
        $delete_stmt->bindParam(':seance_id', $seance_id);

        if ($delete_stmt->execute()) {
            echo "Seance deleted successfully!";
        } else {
            echo "Error deleting seance: " . $delete_stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
} else {
    echo "Invalid seance ID";
}

exit;
?>
