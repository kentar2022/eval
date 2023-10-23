<?php
//Ce script envoie les commentaires non-filtrés dans la page de filtration
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

$query = "SELECT id, text, nickname, rating FROM comments";



$result = mysqli_query($conn, $query);

$comments = array();
while ($row = mysqli_fetch_assoc($result)) {
  $comments[] = array(
    'text' => $row['text'],
    'nickname' => $row['nickname'],
    'rating' => $row['rating'],
    'id' => $row['id']
  );
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($comments);
?>
