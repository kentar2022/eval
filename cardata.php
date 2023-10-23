<?php

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}


$sql = "SELECT brand, price, mileage, color, release_date FROM cars";
$result = $conn->query($sql);


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


$conn->close();
?>
