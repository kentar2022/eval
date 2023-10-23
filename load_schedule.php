<?php
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
  die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

$sql = "SELECT day, time_intervals FROM schedule";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

$conn->close();

header('Content-Type: application/json'); 
echo json_encode($data); 
?>
