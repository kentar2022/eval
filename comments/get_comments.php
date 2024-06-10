<?php
//Ce script envoie les commentaires non-filtrés dans la page de filtration
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

$query = "SELECT id, text, nickname, rating FROM comments";
$result = $conn->query($query);

$comments = array();
while ($row = $result->fetch_assoc()) {
    $comments[] = array(
        'text' => $row['text'],
        'nickname' => $row['nickname'],
        'rating' => $row['rating'],
        'id' => $row['id']
    );
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($comments);
?>
