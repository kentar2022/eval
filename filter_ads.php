<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$imageFolder = "cars_images/";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

$brandFilter = isset($_GET['brand']) ? $_GET['brand'] : '';
$priceFilter = isset($_GET['price']) ? $_GET['price'] : '';

$sql = "SELECT * FROM cars WHERE 1=1";

if (!empty($brandFilter)) {
    $sql .= " AND brand = ?";
}

if (!empty($priceFilter)) {
    $sql .= " AND price <= ?";
}

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error in preparing statement: " . $conn->error);
}

if (!empty($brandFilter)) {
    $stmt->bind_param("s", $brandFilter);
}

if (!empty($priceFilter)) {
    $stmt->bind_param("s", $priceFilter);
}

$stmt->execute();
$result = $


?>
