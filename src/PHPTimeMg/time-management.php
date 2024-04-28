<?php
require_once '../PHPAuth/config.php';

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

// Check if form is submitted
if(isset($_POST['addtask'])) {
    // Get form data
    $day = mysqli_real_escape_string($db, $_POST['day']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $startTime = mysqli_real_escape_string($db, $_POST['startTime']);
    $endTime = mysqli_real_escape_string($db, $_POST['endTime']);
    $userId = $_SESSION['user_id'];

    // Prepare an insert statement
    $sql = "INSERT INTO tasks (user_id, day, title, start_time, end_time) VALUES (?, ?, ?, ?, ?)";

    // Initialize a statement
    $stmt = $db->prepare($sql);

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("issss", $userId, $day, $title, $startTime, $endTime);

    // Attempt to execute the prepared statement
    if($stmt->execute()){
        echo "Task added successfully.";
    } else{
        echo "Oops! Something went wrong. Please try again later.";
        // Print error message
        echo "Error: " . $stmt->error;
    }
    // Close statement
    $stmt->close();
}
?>

<script>
// Get the form and the two buttons
var form = document.getElementById('time_mg');
var showFormButton = document.getElementById('showForm');
var closeFormButton = document.getElementById('closeForm');

// Initially hide the form
form.style.display = 'none';

// Show the form and the "Close" button when the "Show Add Task Form" button is clicked
showFormButton.addEventListener('click', function() {
    form.style.display = 'block';
    closeFormButton.style.display = 'block'; // Show the "Close" button
});

// Hide the form and the "Close" button when the "Close" button is clicked
closeFormButton.addEventListener('click', function() {
    form.style.display = 'none';
    closeFormButton.style.display = 'none'; // Hide the "Close" button
});

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-10">
  <div class="flex items-center justify-start gap-4 mt-4">
    <!-- button to show form  -->
    <button id="showForm" class="shadow-md bg-purple-300 hover:bg-purple-500 text-sm text-white font-medium py-1 px-2 rounded focus:outline-none focus:shadow-outline">+ Add Task</button>
    <!-- button to close the form  -->
    <button id="closeForm" style="display: none" class="shadow-md bg-red-300 hover:bg-red-400 text-sm text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Close -</button>
  </div>
    <!-- Form for adding tasks -->
    <form id="time_mg" class="mt-4 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="day">Day:</label>
        <select id="day" name="day" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title:</label>
        <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="startTime">Start Time:</label>
        <input type="time" id="startTime" name="startTime" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="endTime">End Time:</label>
        <input type="time" id="endTime" name="endTime" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="flex items-center justify-between">
        <input type="submit" name="addtask" id="addTaskButton0" value="add task" class="bg-purple-400 hover:bg-purple-500 cursor-pointer text-white text-sm font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    </div>
</form>
<div class="mt-6 rounded-t-xl shadow-md ">
  <div class="shadow-md rounded-t-xl">
    <div class="mb-4 flex items-center justify-start rounded-t-xl gap-28 bg-gray-100 p-4">
      <div class="text-xl font-bold p-2">User</div>
      <div class="mt-1 text-xl text-gray-800 font-bold"><?php echo $_SESSION['username'] ?></div>
    </div>
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Mon 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4 text-black" id="Monday">
            <!-- dynamic tasks -->
      </div>
    </div>

    <div class="mt-4 grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Tue 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4" id="Tuesday">

      </div>
    </div>

    <div class="mt-4 grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Wed 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4" id="Wednesday">

      </div>
    </div>

    <div class="mt-4 grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Thu 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4" id="Thursday">

      </div>
    </div>

    <div class="mt-4 grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Fri 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4" id="Friday">

      </div>
    </div>

    <div class="mt-4 grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Sat 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4" id="Saturday">

      </div>
    </div>

    <div class="mt-4 grid grid-cols-6 gap-4">
      <div class="col-span-1">
        <div class="text-sm font-bold text-gray-700 bg-gray-100 px-4 py-9 rounded text-center">Sun 09/02</div>
      </div>
      <div class="col-span-5 grid grid-cols-4 gap-4" id="Sunday">

      </div>
    </div>
  </div>
</div>

</body>
</html>

