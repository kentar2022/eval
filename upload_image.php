<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $targetDirectory = 'cars_images/';
  $targetFile = $targetDirectory . basename($_FILES['image']['name']);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  $check = getimagesize($_FILES['image']['tmp_name']);
  if ($check === false) {
    echo "Erreur: Le fichier n'est pas une image.";
    $uploadOk = 0;
  }


  if (file_exists($targetFile)) {
    echo 'Erreur: Un fichier avec ce nom éxiste déjà.';
    $uploadOk = 0;
  }

  
   if ($_FILES['image']['size'] > 500000) {
     echo 'Erreur: le fichier est trop grand';
     $uploadOk = 0;
   }

  
   if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
     echo 'Erreur: Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.';
     $uploadOk = 0;
   }

  if ($uploadOk === 1) {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      echo 'Hello';
     /* header('Location: admin.html');*/
    } else {
      echo 'Erreur lors du chargement du fichier.';
    }
  }
}
?>