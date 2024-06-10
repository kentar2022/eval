<?php

error_reporting(0);
ini_set('display_errors', 0);


$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $brand = htmlspecialchars($_POST['brand']);
    $price = floatval($_POST['price']);
    $mileage = intval($_POST['mileage']);
    $color = htmlspecialchars($_POST['color']);
    $colorHtml = htmlspecialchars($_POST['color_html']);
    $releaseDate = htmlspecialchars($_POST['releaseDate']);
    $details = htmlspecialchars($_POST['details']);

 
   $sql = "INSERT INTO cars (brand, price, mileage, color, color_html, release_date, details)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Erreur de préparation de la requête : " . $conn->error);
        die("Une erreur s'est produite lors de l'ajout de données à la base de données.");
    }

    $stmt->bind_param("sdissss", $brand, $price, $mileage, $color, $colorHtml, $releaseDate, $details);

    if ($stmt->execute()) {
        $carId = $stmt->insert_id;

     
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $targetDirectory = '../cars_images/';
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $maxFileSize = 5242880; 

            $imageCount = count($_FILES['image']['name']);

            for ($i = 0; $i < $imageCount; $i++) {
                $imageExtension = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
                $imageName = $carId . '.' . $imageExtension;
                $imageTmpName = $_FILES['image']['tmp_name'][$i];
                $imagePath = $targetDirectory . $imageName;

                if (!in_array(strtolower($imageExtension), $allowedTypes) || $_FILES['image']['size'][$i] > $maxFileSize) {
                    error_log("Erreur : Le type de fichier n'est pas autorisé ou la taille du fichier dépasse la limite autorisée.");
                    die("Une erreur s'est produite lors du téléchargement des images.");
                }

                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    echo "L'image " . ($i + 1) . " a été téléchargée avec succès.\n";
                } else {
                    error_log("Erreur lors du téléchargement de l'image " . ($i + 1) . ".");
                    echo "Erreur lors du téléchargement de l'image " . ($i + 1) . ".\n";
                }
            }
        }

        echo "Données ajoutées avec succès à la base de données.";
    } else {
        error_log("Une erreur s'est produite lors de l'ajout de données à la base de données : " . $stmt->error);
        echo "Une erreur s'est produite lors de l'ajout de données à la base de données.";
    }


    $stmt->close();
    $conn->close();
}
?>
