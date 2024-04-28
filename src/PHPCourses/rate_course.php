<?php
include '../PHPAuth/config.php';

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

// Check if the necessary POST data is set
if(!isset($_POST['courseId']) || !isset($_POST['rating'])){
    echo "Missing course ID or rating.";
    exit;
}

// Get the course ID and rating from the POST data
$courseId = $_POST['courseId'];
$rating = $_POST['rating'];

// Prepare the SQL statement
$stmt = $db->prepare("INSERT INTO ratings (user_id, course_id, rating) VALUES (?, ?, ?)");

// Bind the user ID, course ID, and rating to the SQL statement
$stmt->bind_param("iii", $_SESSION['user_id'], $courseId, $rating);

// Execute the SQL statement
if ($stmt->execute()) {
    echo "Course rated successfully!";
} else {
    echo "Error rating course: " . $stmt->error;
}

$db->close();

