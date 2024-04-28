<?php
include '../PHPAuth/config.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['update-profile'])) {
    $userId = $_SESSION["user_id"];
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    
    // Update query
    $updateSql = "UPDATE users SET username='$newUsername', email='$newEmail' WHERE id=$userId";
    
    if ($db->query($updateSql) === TRUE) {
        echo "User data updated successfully!";
    } else {
        echo "Error updating user data: " . $db->error;
    }
    
    // Close connection
    $db->close();
}

