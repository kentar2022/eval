<?php
header('Content-Type: text/html; charset=UTF-8');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "SELECT details FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($details);
    $stmt->fetch();
    $stmt->close();

    if (isset($details)) {
        echo $details;
    } else {
        echo 'Variable $details is not defined.';
    }
} else {
    echo 'Variable $id is not defined.';
}

$conn->close();
?>
