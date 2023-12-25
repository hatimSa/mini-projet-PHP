<?php

session_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "profmanage";

include('prof_template.php');


// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent SQL injection
    $seance_name = mysqli_real_escape_string($conn, $_POST["seance_name"]);
    $seance_date = mysqli_real_escape_string($conn, $_POST["seance_date"]);
    $seance_time_begin = mysqli_real_escape_string($conn, $_POST["seance_time_begin"]);
    $seance_time_end = mysqli_real_escape_string($conn, $_POST["seance_time_end"]);
    $departement = mysqli_real_escape_string($conn, $_POST["departement"]);
    $filiere = mysqli_real_escape_string($conn, $_POST["filiere"]);
    $matiere = mysqli_real_escape_string($conn, $_POST["matiere"]);
    $salle_num = mysqli_real_escape_string($conn, $_POST["salle_num"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO seance (seance_name, seance_date, seance_time_begin, seance_time_end, departement, filiere, matiere, salle_num) 
            VALUES ('$seance_name', '$seance_date', '$seance_time_begin', '$seance_time_end', '$departement', '$filiere', '$matiere', '$salle_num')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une seance</title>
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
    <h2>Ajouter une séance</h2>

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

    <form action="seance_add.php" method="post">
        <!-- Créez votre formulaire avec les champs nécessaires -->
        <label for="nom">Nom de séance :</label>
        <input type="text" name="seance_name" required><br>

        <label for="date">Date de séance :</label>
        <input type="date" name="seance_date" required><br>

        <label for="heure">Heure de départ de séance :</label>
        <input type="time" name="seance_time_begin" required><br>

        <label for="heure">Heure de fin de séance :</label>
        <input type="time" name="seance_time_end" required><br>

        <label for="departement">Département :</label>
        <input type="text" name="departement" required><br>

        <label for="filiere">Filière :</label>
        <input type="text" name="filiere" required><br>

        <label for="matiere">Matières :</label>
        <input type="text" name="matiere" required><br>

        <label for="salle">Salle/Amphi :</label>
        <input type="text" name="salle_num" required><br>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>