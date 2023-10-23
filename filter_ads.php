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
  die("Database connection eror: " . $conn->connect_error);
}


$brandFilter = isset($_GET['brand']) ? $_GET['brand'] : '';
$priceFilter = isset($_GET['price']) ? $_GET['price'] : '';


$sql = "SELECT * FROM cars WHERE 1=1";

if (!empty($brandFilter)) {
  $sql .= " AND brand = '$brandFilter'";
}

if (!empty($priceFilter)) {
  $sql .= " AND price <= '$priceFilter'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
   
  }
} else {
  echo "No matching ads found.";
}

$conn->close();
?>
