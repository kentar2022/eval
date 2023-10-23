<?php
$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die('Erreur de connexion à la base de données: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

   
    $query_admin = "SELECT * FROM admin WHERE login = '$login' AND password = '$password'";
    $result_admin = mysqli_query($conn, $query_admin);

    if ($result_admin && mysqli_num_rows($result_admin) > 0) {

        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['login'] = $login;
        
        header('Location: admin.php');
        exit();
    }

    $query_users = "SELECT * FROM users WHERE email = '$login' AND password = '$password'";
    $result_users = mysqli_query($conn, $query_users);

    if ($result_users && mysqli_num_rows($result_users) > 0) {

        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['login'] = $login;

        header('Location: user.php'); 
        exit();
    }

    echo 'Identifiants invalides';

    mysqli_free_result($result_admin);
    mysqli_free_result($result_users);
}

mysqli_close($conn);
?>
