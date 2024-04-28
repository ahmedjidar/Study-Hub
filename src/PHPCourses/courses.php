<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

include '../PHPAuth/config.php';

$result = $db->query("SELECT courses.*, AVG(ratings.rating) as average_rating FROM courses LEFT JOIN ratings ON courses.id = ratings.course_id GROUP BY courses.id");

// add course
echo '
    <button id="add-course-button" class="my-4 shadow-md bg-purple-300 hover:bg-purple-500 text-sm text-white font-medium py-1 px-2 rounded focus:outline-none focus:shadow-outline">
       + Add Course
    </button>

    <div id="add-course-form" class="hidden">
        <form id="course-form" action="../PHPCourses/add_course.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="course-name" class="block text-sm font-medium text-gray-700">Course Name:</label>
                <input type="text" id="course-name" name="course-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="course-image" class="block text-sm font-medium text-gray-700">Course Image:</label>
                <input type="file" id="course-image" name="course-image" accept="image/*" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>  
            <div>
                <label for="course-category" class="block text-sm font-medium text-gray-700">Course Category:</label>
                <input type="text" id="course-category" name="course-category" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="course-date" class="block text-sm font-medium text-gray-700">Course Date:</label>
                <input type="date" id="course-date" name="course-date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="course-instructor" class="block text-sm font-medium text-gray-700">Course Instructor:</label>
                <input type="text" id="course-instructor" name="course-instructor" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <label for="course-link" class="block text-sm font-medium text-gray-700">Course Link:</label>
                <input type="text" id="course-link" name="course-link" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
            <div>
                <input type="submit" value="Add" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
            </div>
        </form>
    </div>

    <script>
        document.getElementById("add-course-button").addEventListener("click", function() {
            var form = document.getElementById("add-course-form");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        });

        document.getElementById("course-form").addEventListener("submit", function(event) {
            var form = document.getElementById("add-course-form");
            form.style.display = "none";
        });
    </script>
';

echo '
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Courses</title>
</head>
<body>
    <div class="grid grid-cols-3 gap-4 mt-4">
';

if ($result->num_rows > 0) {
    while($course = $result->fetch_assoc()) {
        // Convert the binary data to a base64-encoded string
        $courseImage = base64_encode($course["image"]);
        echo '
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-[350px]" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <div class="inline-flex items-center rounded-full whitespace-nowrap border px-2.5 py-0.5 w-fit text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80">
                        ' . $course["category"] . '
                    </div>
                    <img
                        onclick="loadUploadPage(' . $course["id"] . ')"
                        src="data:image/png;base64,' . $courseImage . '"
                        alt="' . $course["name"] . '"
                        class="rounded-2xl shadow-sm cursor-pointer"
                        width="250"
                        height="200"
                        style="aspect-ratio: 350 / 200; object-fit: cover;"
                    />
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-start gap-2">
                        <p class="text-xs text-gray-500">' . $course["date"] . '</p>
                        <p class="text-xs text-gray-500">by ' . $course["instructor"] . '</p>
                    </div>
                    <p class="flex items-center justify-start gap-1 p-1 bg-gray-100 rounded my-2 w-48">';
                    $rating = round($course["average_rating"], 1);
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $rating) {
                            // Full star
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400 w-4 h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
                        } else {
                            // Empty star
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 w-4 h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
                        }
                    }
                    echo ' <span class="ml-2 text-xs font-medium text-black">'.$rating.' out of 5</span></p>
                    <p class="text-lg font-medium text-black">' . $course["name"] . '</p>
                    <div class="flex items-center justify-start gap-2 mt-2">
                        <select id="rating-' . $course["id"] . '" class="outline-none border-none resize-none p-1 text-xs text-yellow-800 font-medium bg-gray-100 rounded">
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                        <button id="rate-' . $course["id"] . '" class="shadow-sm text-xs bg-yellow-400 hover:bg-yellow-500 text-white font-medium p-1 rounded focus:outline-none focus:shadow-outline">Rate Course</button>
                        <a href="#" onclick="viewRatings(' . $course["id"] . ');" class="shadow-sm text-xs hover:bg-gray-100 ring-1 ring-gray-300 text-gray-500 font-medium p-1 rounded focus:outline-none focus:shadow-outline">View Ratings</a>
                    </div>
                </div>
            </div>
        ';
    }
} else {
    echo "No courses found.";
}
?>

<script>
function loadUploadPage(courseId) {
    $('#content').load('../PHPCourses/upload_page.php?course-id=' + courseId);
}
</script>

<?php

// upload modal
echo '
<div id="uploadModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2" id="modal-title">Add a Study Ressource</h3>
                <form action="../PHPCourses/upload.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="course-id" id="course-id">
                    <input type="file" class="p-2 ring-1 ring-gray-500 hover:bg-gray-100 rounded-xl shadow-sm" name="file">
                    <input type="submit" class="p-2 ring-1 ring-gray-500 hover:bg-gray-100 rounded-xl shadow-sm ml-4" value="Upload">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openUploadModal(courseId) {
    document.getElementById("course-id").value = courseId;
    document.getElementById("uploadModal").classList.remove("hidden");
}
</script>
';

// rating modal
echo '
    </div>
    <div id="ratingsModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div id="ratingsContent"></div>
                <button class="text-sm mt-2 bg-purple-400 hover:bg-purple-500 font-medium rounded p-1 text-white" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
    <script>
    function viewRatings(courseId) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../PHPCourses/view_rates.php?courseId=" + courseId, true);
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("ratingsContent").innerHTML = this.responseText;
                document.getElementById("ratingsModal").classList.remove("hidden");
            }
        };
        xhr.send();
    }

    function closeModal() {
        document.getElementById("ratingsModal").classList.add("hidden");
    }
    </script>
</body>
</html>
';

$db->close();

// window.location.href=\'../PHPCourses/upload_page.php?course-id='.$course["id"].'\'