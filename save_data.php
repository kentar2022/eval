<?php
//Ce script sauvegarde les commentaire non-filtrés dans la table temporaire 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userText = $_POST['user_comment'];
    $userText = mysqli_real_escape_string($conn, $userText);

    $userNickname = $_POST['user_nickname'];
    $userNickname = mysqli_real_escape_string($conn, $userNickname);

    $userRating = $_POST['user_rating']; 

    $query = "INSERT INTO comments (text, nickname, rating) VALUES ('$userText', '$userNickname', '$userRating')";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    header('Location: index.html#avis');
    exit();
}

?>
