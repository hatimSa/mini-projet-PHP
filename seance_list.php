<?php
include 'config.php';
include('prof_template.php');

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM seance");
    $stmt->execute();

    $seances = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
        }

        .actions a,
        .actions button {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <h2>Seance List</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de séance</th>
                <th>Date de séance</th>
                <th>Heure de début de séance</th>
                <th>Heure de fin de séance</th>
                <th>Département</th>
                <th>Filière</th>
                <th>Matières</th>
                <th>Salle/Amphi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seances as $seance) : ?>
                <tr>
                    <td><?= $seance['seance_id']; ?></td>
                    <td><?= $seance['seance_name']; ?></td>
                    <td><?= $seance['seance_date']; ?></td>
                    <td><?= $seance['seance_time_begin']; ?></td>
                    <td><?= $seance['seance_time_end']; ?></td>
                    <td><?= $seance['departement']; ?></td>
                    <td><?= $seance['filiere']; ?></td>
                    <td><?= $seance['matiere']; ?></td>
                    <td><?= $seance['salle_num']; ?></td>
                    <td class="actions">
                        <a href="seance_edit.php?id=<?= $seance['seance_id']; ?>" class="btn btn-primary">Update</a>
                        <a href="seance_delete.php?id=<?= $seance['seance_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this seance?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>