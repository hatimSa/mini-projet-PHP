<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';
include('dashboard_template.php');

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM Prof");
    $stmt->execute();

    $professors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Département</th>
                <th scope="col">Filière</th>
                <th scope="col">Matières enseignées</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professors as $professor) : ?>
                <tr>
                    <td><?= $professor['prof_id']; ?></td>
                    <td><?= $professor['prof_full_name']; ?></td>
                    <td><?= $professor['departement']; ?></td>
                    <td><?= $professor['filiere']; ?></td>
                    <td><?= $professor['matiere']; ?></td>
                    <td>
                        <a href="prof_profil.php?id=<?= $professor['prof_id']; ?>" class="btn btn-sm btn-primary align-center">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="prof_edit.php?id=<?= $professor['prof_id']; ?>" class="btn btn-sm btn-info mx-2 align-center">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger align-center" data-toggle="modal" data-target="#confirm-delete-modal-<?= $professor['prof_id']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="confirm-delete-modal-<?= $professor['prof_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-<?= $professor['prof_id']; ?>-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirm-delete-modal-<?= $professor['prof_id']; ?>-label">Confirmation de suppression</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Êtes-vous sûr de vouloir supprimer <?= $professor['prof_full_name']; ?> de la liste des Professeurs ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <form action="delete_prof.php?id=<?= $professor['prof_id']; ?>" method="POST" data-message="<?= $professor['prof_full_name']; ?> a été supprimé avec succès.">
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    </body>

</html>