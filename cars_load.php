<?php
//Script pour suprimer le commentaire de la table temporaire
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

$sql = "SELECT id, brand, price, mileage, color, release_date FROM cars";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error in preparing statement: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div id='carData'>";
        echo "ID: " . $row["id"] . "<br>";
        echo "Brand: " . $row["brand"] . "<br>";
        echo "Price: " . $row["price"] . "<br>";
        echo "Mileage: " . $row["mileage"] . "<br>";
        echo "Color: " . $row["color"] . "<br>";
        echo "Release Date: " . $row["release_date"] . "<br>";
        echo "</div>";
        echo "<br>";
    }
} else {
    echo "No cars found.";
}

$stmt->close();
$conn->close();
?>
