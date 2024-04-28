<?php
// add_course.php
include '../PHPAuth/config.php';

// Sanitize and validate the input data
$courseName = filter_input(INPUT_POST, 'course-name', FILTER_SANITIZE_STRING);
$courseCategory = filter_input(INPUT_POST, 'course-category', FILTER_SANITIZE_STRING);
$courseDate = filter_input(INPUT_POST, 'course-date', FILTER_SANITIZE_STRING);
$courseInstructor = filter_input(INPUT_POST, 'course-instructor', FILTER_SANITIZE_STRING);
$courseLink = filter_input(INPUT_POST, 'course-link', FILTER_SANITIZE_URL);

if (isset($_FILES['course-image'])) {
    if ($_FILES['course-image']['error'] == 0) {
        // Read the contents of the image file into a string
        $image = $_FILES['course-image']['tmp_name'];
        $courseImage = file_get_contents($image);
    } else {
        // Handle the error
        echo 'File upload error: ' . $_FILES['course-image']['error'];
    }
} else {
    $courseImage = null;
    echo 'No file was uploaded.';
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    
}

if ($courseName && $courseImage && $courseCategory && $courseDate && $courseInstructor && $courseLink) {
    // Insert the new course into the database
    $stmt = $db->prepare("INSERT INTO courses (name, image, category, date, instructor, link) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $courseName, $courseImage, $courseCategory, $courseDate, $courseInstructor, $courseLink);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../PHPDashboard/dashboard.php");
    } else {
        echo "<link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>";
        echo "<p class='block text-2xl text-thin text-red-600 p-4 bg-red-200 shadow-md'> Failed to add course.</p>";
        echo "<a class='px-3 py-2 bg-red-500 text-white text-sm my-4 mx-2 rounded shadow-sm' href='../PHPDashboard/dashboard.php'>Go back</a>";
    }

    $stmt->close();
} else {
    echo "<link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>";
    echo "<p class='block text-2xl text-thin text-red-600 p-4 bg-red-200 shadow-md'> Invalid input data.</p>";
    echo "<a class='px-3 py-2 bg-red-500 text-white text-sm my-4 mx-2 rounded shadow-sm' href='../PHPDashboard/dashboard.php'>Go back</a>";
    echo 'File upload error: ' . $_FILES['course-image']['error'];
}

$db->close();
