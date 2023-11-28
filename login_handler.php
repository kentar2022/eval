<?php
session_start();

$db_host = 'localhost';
$db_user = 'kentar';
$db_password = 'password';
$db_name = 'mydatabase';
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die('Erreur de connexion à la base de données: ' . mysqli_connect_error());
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token'])) {
    $userToken = $_POST['csrf_token'];

    if ($userToken === $_SESSION['csrf_token']) {
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query_admin = "SELECT * FROM admin WHERE login = '$login'";
        $result_admin = mysqli_query($conn, $query_admin);

        $query_users = "SELECT * FROM users WHERE email = '$login'";
        $result_users = mysqli_query($conn, $query_users);

        if ($result_admin && mysqli_num_rows($result_admin) > 0) {
            $row = mysqli_fetch_assoc($result_admin);
            $stored_password_hash = $row['password'];

            if (password_verify($password, $stored_password_hash)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['login'] = $login;
                header('Location: admin.php');
                exit();
            }
        }

        if ($result_users && mysqli_num_rows($result_users) > 0) {
            $row = mysqli_fetch_assoc($result_users);
            $stored_password_hash = $row['password'];

            if (password_verify($password, $stored_password_hash)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['login'] = $login;
                header('Location: user.php');
                exit();
            }
        }

        echo 'Identifiants invalides';

        mysqli_free_result($result_admin);
        mysqli_free_result($result_users);
    } else {
        echo 'Erreur de sécurité: CSRF token mismatch. Possible attack.';
    }
} else {
    echo 'Erreur de requête: Méthode non autorisée ou token CSRF manquant.';
}

mysqli_close($conn);
?>
