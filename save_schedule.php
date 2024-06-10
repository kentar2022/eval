<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');


$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $day = $_POST['day'];
  $timeIntervals = $_POST['time_intervals'];

  $sql = "INSERT INTO schedule (day, time_intervals) VALUES ('$day', '$timeIntervals')";

  if (mysqli_query($conn, $sql)) {
    header('Location: login/admin.php');
  } else {
    echo "Erreur lors de l'enregistrement des données: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
