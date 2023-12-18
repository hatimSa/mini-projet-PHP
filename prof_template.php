<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ url('css/sidebar.css') }}">

    <title>Prof Dashboard</title>
</head>

<body style="background-color: Azure;">
    <!-- sidebar -->

    <div class="offcanvas offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Menu</h6>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-0">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                <li class="nav-item">
                    <a href="prof_dash.php" class="nav-link text-truncate">
                        <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-add"></i><span class="ms-1 d-none d-sm-inline">Gestion des cours</span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdown">
                        <li><a class="dropdown-item" href="#">Ajouter une séance</a></li>
                        <li><a class="dropdown-item" href="#">Salle</a></li>
                        <li><a class="dropdown-item" href="index.php">Upload des cours</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i><span class="ms-1 d-none d-sm-inline">Votre Profil</span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdown">
                        <li><a class="dropdown-item"><?php echo isset($professor['prof_full_name']) ? $professor['prof_full_name'] : ''; ?></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-item">
                            <a href="#" onclick="document.getElementById('form-logout').submit();">
                                <form action="logout.php" id="form-logout"></form>
                                Deconnexion
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col p-4">

                <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb">
                        </nav>
                        <!-- toggler -->
                        <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                            <i class="bi bi-list" style="width: 50px; height: 50px;"></i>
                        </button>
                    </div>

                </nav>

            </div>
        </div>
    </div>
    <main class="container">
        <div>
        </div>
    </main>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>