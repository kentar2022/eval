<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die('Erreur de connexion à la base de données: ' . mysqli_connect_error());
}

$query = "SELECT text, nickname, rating FROM comments"; 
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class=""><p>' . htmlspecialchars($row['text']) . '</p>';
    echo '<p>Nickname: ' . ($row['nickname'] ? htmlspecialchars($row['nickname']) : '') . '</p>'; 
    echo '<p style="color:yellow;">Rating: ' . $row['rating'] . '</p>'; 
}

    mysqli_free_result($result);
} else {
    echo 'Erreur d exécution de la requête: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
