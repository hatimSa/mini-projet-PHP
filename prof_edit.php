<?php
session_start();
include 'config.php';
include 'dashboard_template.php';

$professor = [];
$successMessage = '';
$departements = [];
$filieres = [];

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si l'ID du professeur est défini dans l'URL
    if (isset($_GET['id'])) {
        $profId = $_GET['id'];

        // Récupère les nouvelles valeurs depuis le formulaire
        $profFullName = $_POST['prof_full_name'];
        $departement = $_POST['departement'];
        $filiere = $_POST['filiere'];
        $matiere = $_POST['matiere'];

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prépare la requête de mise à jour dans la table 'prof'
            $stmt = $conn->prepare("UPDATE Prof SET prof_full_name = :profFullName, departement = :departement, filiere = :filiere, matiere = :matiere WHERE prof_id = :profId");

            // Lie les valeurs aux paramètres de la requête
            $stmt->bindParam(':profFullName', $profFullName);
            $stmt->bindParam(':departement', $departement);
            $stmt->bindParam(':filiere', $filiere);
            $stmt->bindParam(':matiere', $matiere);
            $stmt->bindParam(':profId', $profId);

            // Exécute la requête de mise à jour
            $stmt->execute();

            // Prépare la requête de mise à jour dans la table 'users'
            $stmt2 = $conn->prepare("UPDATE users SET username = :profFullName WHERE user_id = :profId");
            $stmt2->bindParam(':profFullName', $profFullName);
            $stmt2->bindParam(':profId', $profId);
            $stmt2->execute();

            // Redirection vers prof_list.php avec un message de succès
            header("Location: prof_list.php?success=1&message=" . urlencode("Les informations du professeur ont été mises à jour avec succès."));
            exit();
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    } else {
        echo "ID du professeur non fourni.";
    }
} elseif (isset($_GET['id'])) {
    // Si l'ID du professeur est fourni dans l'URL, récupère ses informations
    $profId = $_GET['id'];

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prépare la requête de sélection du professeur
        $stmt = $conn->prepare("SELECT * FROM Prof WHERE prof_id = :profId");
        $stmt->bindParam(':profId', $profId);
        $stmt->execute();

        // Récupère les informations du professeur
        $professor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$professor) {
            echo "Professeur non trouvé.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
        exit();
    }
} else {
    echo "ID du professeur non fourni.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Professeur</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 16px;
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Modifier un Professeur</h2>

    <form action="prof_edit.php?id=<?= $professor['prof_id']; ?>" method="post">
        <!-- Affichez les données existantes dans le formulaire pour modification -->
        <label for="nom">Nom :</label>
        <input type="text" name="prof_full_name" value="<?= $professor['prof_full_name'] ?? ''; ?>" required>

        <label for="departement">Département :</label>
        <input type="text" name="departement" value="<?= $professor['departement'] ?? ''; ?>" required>

        <label for="filiere">Filière :</label>
        <input type="text" name="filiere" value="<?= $professor['filiere'] ?? ''; ?>" required>

        <label for="matiere">Matières enseignées :</label>
        <input type="text" name="matiere" value="<?= $professor['matiere'] ?? ''; ?>" required>

        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>

</html>