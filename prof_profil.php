<?php

include 'config.php';
include('dashboard_template.php');

$professor = [];

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ajoutez un paramètre pour spécifier l'ID du professeur que vous souhaitez récupérer
    $professor_id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($professor_id) {
        $stmt = $conn->prepare("SELECT * FROM Prof WHERE prof_id = :prof_id");
        $stmt->bindParam(':prof_id', $professor_id);
        $stmt->execute();

        $professor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$professor) {
            echo "Aucun professeur trouvé avec l'ID spécifié.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">



    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Infos des Employés</title>
</head>

<body style="background-color: Azure">

    <section style="background-color: #eee;">
        <div class="container py-5 mb-3">
            <div class="row">
                <div class="container">
                    <div class="main-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="images/profil.png" alt="" class="rounded-circle" width="150">
                                            <div class="mt-3">
                                                <form method="POST" action="" enctype="multipart/form-data">

                                                    <div class="card-body">
                                                        <input type="file" id="photoInput" name="photo">
                                                    </div>
                                                    <h4><?php echo isset($professor['prof_full_name']) ? $professor['prof_full_name'] : ''; ?></h4>
                                                    <p class="text-secondary mb-1">Prof chez FSA</p>
                                                    <p class="text-muted font-size-sm">Agadir</p>
                                                    <button type="button" class="btn btn-danger" data-target="#deleteModal" data-toggle="modal">Supprimer</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de Suppression</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Êtes-vous sûr de vouloir supprimer cet Employé(e)?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                    <button type="button" class="btn btn-danger" id="deleteButton" data-id="confirm-delete-modal-<?= $professor['prof_id']; ?>-label">Supprimer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="prof_edit.php?id=<?= $professor['prof_id']; ?>" class="btn btn-outline-info">Modifier</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">ID</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo isset($professor['prof_id']) ? $professor['prof_id'] : ''; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nom Complet</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo isset($professor['prof_full_name']) ? $professor['prof_full_name'] : ''; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Département</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo isset($professor['departement']) ? $professor['departement'] : ''; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Filière</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo isset($professor['filiere']) ? $professor['filiere'] : ''; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Matières enseignèes</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo isset($professor['matiere']) ? $professor['matiere'] : ''; ?>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>