<?php
include '../PHPAuth/config.php';

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

$userId = $_SESSION["user_id"];

// Query to fetch data
$sql = "SELECT id, day, title, start_time, end_time FROM tasks WHERE user_id=" . $userId;
$result = $db->query($sql);

// Fetch data and encode it as JSON
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($data);

// Close connection
$db->close();








