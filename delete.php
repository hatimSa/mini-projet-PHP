<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection details
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "mini_projet";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the file from the database
    $sql = "DELETE FROM files WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "File deleted successfully.";
    } else {
        echo "Error deleting file: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
