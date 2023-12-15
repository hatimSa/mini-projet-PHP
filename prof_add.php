<?php
include 'config.php';
include('dashboard_template.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['prof_full_name'];
    $departement = $_POST['departement'];
    $filiere = $_POST['filiere'];
    $matiere = $_POST['matiere'];

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Définir le nom d'utilisateur en utilisant le nom du professeur (ou une autre valeur appropriée)
        $username = strtolower(str_replace(' ', '', $nom));

        // Générer un mot de passe sécurisé (vous pouvez utiliser une méthode plus sécurisée pour la génération)
        $password = generateSecurePassword();

        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 1. Insérer l'utilisateur dans la table Users
        $stmtUser = $conn->prepare("INSERT INTO Users(username, password, role) VALUES (:username, :password, 'prof')");
        $stmtUser->bindParam(':username', $username);
        $stmtUser->bindParam(':password', $hashedPassword);
        $stmtUser->execute();

        // 2. Récupérer l'ID de l'utilisateur nouvellement inséré
        $userId = $conn->lastInsertId();

        // 3. Insérer le professeur dans la table Prof avec l'ID de l'utilisateur
        $stmtProf = $conn->prepare("INSERT INTO Prof(prof_full_name, departement, filiere, matiere, prof_id) VALUES (:nom, :departement, :filiere, :matiere, :userId)");
        $stmtProf->bindParam(':nom', $nom);
        $stmtProf->bindParam(':departement', $departement);
        $stmtProf->bindParam(':filiere', $filiere);
        $stmtProf->bindParam(':matiere', $matiere);
        $stmtProf->bindParam(':userId', $userId);
        $stmtProf->execute();

        $_SESSION['success_message'] = "Le professeur a été ajouté avec succès.";

        // Rediriger vers la liste des professeurs ou une autre page
        header("Location: prof_list.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erreur: " . $e->getMessage();

        // Rediriger vers la page d'ajout avec un message d'erreur
        header("Location: prof_add.php");
        exit();
    }
}

// Fonction pour générer un mot de passe sécurisé
function generateSecurePassword($length = 12)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
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
    <h2>Ajouter un Professeur</h2>

    <!-- Afficher le message de succès ou d'erreur -->
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="message">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']); // Supprimer le message de la session après l'affichage
    } elseif (isset($_SESSION['error_message'])) {
        echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']); // Supprimer le message de la session après l'affichage
    }
    ?>

    <form action="prof_add.php" method="post">
        <!-- Créez votre formulaire avec les champs nécessaires -->
        <label for="nom">Nom :</label>
        <input type="text" name="prof_full_name" required><br>

        <label for="departement">Département :</label>
        <input type="text" name="departement" required><br>

        <label for="filiere">Filière :</label>
        <input type="text" name="filiere" required><br>

        <label for="matiere">Matières enseignées :</label>
        <input type="text" name="matiere" required><br>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>