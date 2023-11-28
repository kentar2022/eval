<?php
session_start();


$csrfToken = bin2hex(random_bytes(32));


$_SESSION['csrf_token'] = $csrfToken;


header('Content-Type: application/json');
echo json_encode(['csrf_token' => $csrfToken]);
?>
