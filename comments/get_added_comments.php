<?php
//Script pour obtenir les commentaires filtrés
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die('Erreur de connexion à la base de données: ' . mysqli_connect_error());
}

$query = "SELECT text, nickname, rating FROM filtred_comments";
$result = mysqli_query($conn, $query);

$addedComments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $addedComments[] = array(
        'text' => $row['text'],
        'nickname' => $row['nickname'],
        'rating' => $row['rating']
    );
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($addedComments);
?>
