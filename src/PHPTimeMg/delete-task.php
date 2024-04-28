<?php
include '../PHPAuth/config.php';

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

$userId = $_SESSION["user_id"];

// Check if a delete request has been made
if(isset($_POST['delete-task']) && isset($_POST['task-id'])) {
    $taskId = $_POST['task-id'];

    // Query to delete task
    $sql = "DELETE FROM tasks WHERE id=" . $taskId . " AND user_id=" . $userId;
    $db->query($sql);
}

// Query to fetch data
$sql = "SELECT day, title, start_time, end_time FROM tasks WHERE user_id=" . $userId;
$result = $db->query($sql);

// Fetch data and encode it as JSON
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($data);

// Close connection
$db->close();

