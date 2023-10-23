<?php
//Script pour ajouter les commentaires filtrés dans la table des commentaires filtrés
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = $_POST['commentId'];
    
    $querySelect = "SELECT * FROM comments WHERE id = $commentId";
    $resultSelect = mysqli_query($conn, $querySelect);
    
    if ($resultSelect && $row = mysqli_fetch_assoc($resultSelect)) {

        $commentText = $row['text'];
        $commentNickname = $row['nickname'];
        $commentRating = $row['rating'];
        

        $queryInsert = "INSERT INTO filtred_comments (text, nickname, rating) VALUES ('$commentText', '$commentNickname', $commentRating)";
        $resultInsert = mysqli_query($conn, $queryInsert);
        

        if ($resultInsert) {
            $queryDelete = "DELETE FROM comments WHERE id = $commentId";
            $resultDelete = mysqli_query($conn, $queryDelete);
            
            if ($resultDelete) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false));
            }
        } else {
            echo json_encode(array('success' => false));
        }
    } else {
        echo json_encode(array('success' => false));
    }
    
    exit();
}
?>
