<?php
include 'config.php';

$password = password_hash('password', PASSWORD_DEFAULT);  

$sql = "INSERT INTO users (email, password, role) VALUES ('admin@example.com', '$password', 'admin')";

if ($conn->query($sql) === TRUE) {
    echo "Le compte de l'administrateur est bien créé.";
} else {
    echo "Erreur lors de la création du compte d'administrateur: " . $conn->error;
}

$conn->close();
?>
