<?php
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

$sql = "SELECT brand, price, mileage, color, release_date FROM cars";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erreur de préparation de la requête: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Brand: " . $row["brand"] . "</p>";
        echo "<p>Price: " . $row["price"] . "</p>";
        echo "<p>Mileage: " . $row["mileage"] . "</p>";
        echo "<p>Color: " . $row["color"] . "</p>";
        echo "<p>Release Date: " . $row["release_date"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Il n'y a pas de données dans la table des voitures.";
}

$stmt->close();
$conn->close();
?>
