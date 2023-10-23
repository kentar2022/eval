<?php
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
  die("Database connection eror: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $email, $password);

  if ($stmt->execute()) {
    header('Location: admin.php');
  } else {
    echo "Erreur lors de l'inscription.";
  }

  $stmt->close();
} else {
  echo "Veuillez remplir tout les champs.";
}

$conn->close();
?>
