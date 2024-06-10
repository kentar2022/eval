<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['worker_email']);
    $password = password_hash($_POST['worker_password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', 'worker')";

    if ($conn->query($sql) === TRUE) {
        echo "Le compte de l'employé est bien créé.";
    } else {
        echo "Erreur lors de la création du compte d'employé : " . $conn->error;
    }

    $conn->close();
}
?>
