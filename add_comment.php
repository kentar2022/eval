<?php
//Script pour ajouter les commentaires filtrés dans la table des commentaires filtrés
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);


if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $commentId = intval($_POST['commentId']);

   
    $querySelect = "SELECT * FROM comments WHERE id = ?";
    $stmtSelect = $conn->prepare($querySelect);
    $stmtSelect->bind_param("i", $commentId);
    $stmtSelect->execute();
    $resultSelect = $stmtSelect->get_result();

    
    if ($resultSelect && $row = $resultSelect->fetch_assoc()) {
        $commentText = $row['text'];
        $commentNickname = $row['nickname'];
        $commentRating = $row['rating'];

       
        $queryInsert = "INSERT INTO filtred_comments (text, nickname, rating) VALUES (?, ?, ?)";
        $stmtInsert = $conn->prepare($queryInsert);
        $stmtInsert->bind_param("ssi", $commentText, $commentNickname, $commentRating);
        $resultInsert = $stmtInsert->execute();

       
        if ($resultInsert) {
           
            $queryDelete = "DELETE FROM comments WHERE id = ?";
            $stmtDelete = $conn->prepare($queryDelete);
            $stmtDelete->bind_param("i", $commentId);
            $resultDelete = $stmtDelete->execute();

          
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

    
    $stmtSelect->close();
    $stmtInsert->close();
    $stmtDelete->close();
    $conn->close();
    
    exit();
}
?>
