<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

// Check if the course ID is set
if(!isset($_GET['courseId'])){
    echo "Missing course ID.";
    exit;
}

include '../PHPAuth/config.php';

// Get the course ID from the GET data
$courseId = $_GET['courseId'];

// Get the ratings for the course from the database
$result = $db->query("SELECT users.username, ratings.rating FROM ratings JOIN users ON ratings.user_id = users.id WHERE ratings.course_id = " . $courseId);

if ($result->num_rows > 0) {
    // Output the ratings
    echo '
        <div class="flex flex-col gap-4 overflow-y-scroll p-4 h-96">
            <p class="text-xl text-gray-400 font-medium mb-4">All users reviews for this course</p>
    ';
    while($rating = $result->fetch_assoc()) {
        $stars = '';
        for ($i = 0; $i < 5; $i++) {
            if ($i < $rating["rating"]) {
                // Full star
                $stars .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400 w-5 h-5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
            } else {
                // Empty star
                $stars .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 w-5 h-5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
            }
        }
        echo '
            <div class="shadow-md rouneded-lg">
                <div class="flex flex-col gap-6 p-4 shadow-md rounded-lg">
                    <p class="text-lg text-gray-500"><span class="text-black">Student Name</span>: ' . $rating["username"] . '</p>
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-400">No Reviews...</p>
                        <div class="flex items-center justify-end gap-1">' . $stars . ' ' . $rating["rating"] . '<span class="text-sm font-medium text-black">/5</span></div>
                    </div>
                </div>
            </div>
        ';
    }
    echo '</div>';
} else {
    echo "No ratings found.";
}

// Close the database connection
$db->close();

