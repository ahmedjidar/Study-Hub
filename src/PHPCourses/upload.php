<?php
// include '../PHPAuth/config.php';

// $courseId = filter_input(INPUT_POST, 'course-id', FILTER_SANITIZE_NUMBER_INT);
// $file = $_FILES['file'];

// if ($courseId && $file && $file['error'] == 0) {

//     $dir = "../uploads/$courseId";
//     if (!is_dir($dir)) {
//         mkdir($dir, 0777, true);
//     }

//     $filePath = $dir . '/' . basename($file['name']);
//     if (move_uploaded_file($file['tmp_name'], $filePath)) {
//         header("Location: upload_page.php?course-id=$courseId");
//     } else {
//         echo "Failed to upload file.";
//     }
// } else {
//     echo "Invalid input data.";
// }

include '../PHPAuth/config.php';

$courseId = filter_input(INPUT_POST, 'course-id', FILTER_SANITIZE_NUMBER_INT);
$file = $_FILES['file'];

if ($courseId && $file && $file['error'] == 0) {

    $dir = "../uploads/$courseId";
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $filePath = $dir . '/' . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $fileModTime = date("F d Y H:i:s.", filemtime($filePath));
        echo json_encode(array('status' => 'success', 'fileName' => $file['name'], 'filePath' => $filePath, 'fileModTime' => $fileModTime));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to upload file.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid input data.'));
}





