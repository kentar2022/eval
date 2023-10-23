<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $mileage = $_POST['mileage'];
    $color = $_POST['color'];
    $colorHtml = $_POST['color_html'];
    $releaseDate = $_POST['releaseDate'];
    $details = $_POST['details'];

    $db_host = 'localhost';
    $db_user = 'kentar';
    $db_password = 'password';
    $db_name = 'mydatabase';

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql = "INSERT INTO cars (brand, price, mileage, color, color_html, release_date, details)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);


    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("sdissss", $brand, $price, $mileage, $color, $colorHtml, $releaseDate, $details);

    if ($stmt->execute()) {
        $carId = mysqli_insert_id($conn);

        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $targetDirectory = './cars_images/';
            $imageCount = count($_FILES['image']['name']);

            for ($i = 0; $i < $imageCount; $i++) {
                $imageName = $carId . '.' . pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
                $imageTmpName = $_FILES['image']['tmp_name'][$i];
                $imagePath = $targetDirectory . $imageName;

                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    echo "L'image " . ($i + 1) . " a été téléchargée avec succès.\n";
                } else {
                    echo "Erreur lors du téléchargement de l'image " . ($i + 1) . ".\n";
                }
            }
        }

        echo "Données ajoutées avec succès à la base de données.";
    } else {
        echo "Une erreur s'est produite lors de l'ajout de données à la base de données : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>