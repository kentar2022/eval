<?php
//Script pour suprimer le commentaire de la table temporaire
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = $_POST['commentId'];
    $query = "DELETE FROM comments WHERE id = $commentId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }

    exit();
}
?>
