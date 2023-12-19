<?php

include 'config.php';
include('dashboard_template.php');

$user = [];

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ajoutez un paramètre pour spécifier l'ID de l'admin que vous souhaitez récupérer
    $user = isset($_GET['id']) ? $_GET['id'] : null;

    if ($user) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'admin'");
        $stmt->bindParam('admin', $user);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "Aucun admin trouvé avec l'ID spécifié.";
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
                                                    <h4>Admin</h4>
                                                    <p class="text-secondary mb-1">Admin de l'application</p>
                                                    <p class="text-muted font-size-sm">Agadir</p>
                                                </form>
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
                                                1
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nom Complet</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                Admin
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