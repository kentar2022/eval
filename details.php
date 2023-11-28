<?php
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'kentar';
$db_name = 'ecf_projet';
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $carId = intval($_GET['id']);

    $sql = "SELECT details FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $details = $row["details"];
            echo "<p>" . $details . "</p>";
        }
    } else {
        echo "Details not found.";
    }

    $stmt->close();
} else {
    echo "Car ID not provided.";
}

$conn->close();
?>
