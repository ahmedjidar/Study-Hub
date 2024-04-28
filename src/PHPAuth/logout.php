<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['logout'])) {
    // Unset the username session variable
    unset($_SESSION['username']);

    // Redirect to login.php
    header("Location: ../PHPAuth/login.php");
    exit;
}

$username = $_SESSION['username'] ?? 'Guest';


