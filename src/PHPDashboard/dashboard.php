<?php
session_start();

include '../PHPAuth/logout.php';

if(!isset($_SESSION['username'])){
    header("Location: ../PHPAuth/login.php"); 
    exit;
}
?>

<!-- administration  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        // Add a click event listener to the sidebar links
        $("#sidebar a").click(function() {
            // Get the text of the clicked link
            var linkText = $(this).text();

            // Update the title in the navbar
            $("#nav_title").text(linkText);
        })
        $('#admin').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading of profile data
                    console.log("Admin data loaded successfully!");
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading admin data.");
                }
            });
        });
    });
});
</script>

<!-- annonce  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        $('#annonce').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading of profile data
                    console.log("Annonce data loaded successfully!");
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading admin data.");
                }
            });
        });
    });
});
</script>

<!-- time management -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
$(document).ready(function(){
    $('#time-management').click(function(e){
        e.preventDefault();
        $('#content').load($(this).attr('href'), function() {
            $('#time_mg').on('submit', function(e) {
                e.preventDefault();
                // Get form data
                var day = $('#day').val();
                var title = $('#title').val();
                var startTime = $('#startTime').val();
                var endTime = $('#endTime').val();
                // Check if fields are not empty
                if(day && title && startTime && endTime) {
                    $.ajax({
                        url: '../PHPTimeMg/time-management.php',
                        type: 'post',
                        data: {
                            'addtask': 'addtask',
                            'day': day,
                            'title': title,
                            'startTime': startTime,
                            'endTime': endTime
                        },
                        success: function(response) {
                            // Create task div for the newly added task
                            var dayDiv = $('#'+day); // Get the div for the current day
                            var taskDiv = $('<div>').addClass('block flex-col items-start gap-2 col-span-1 bg-yellow-100 shadow-md hover:bg-yellow-200 cursor:pointer rounded-md p-2');
                            var textDiv = $('<div>').addClass('flex items-center justify-start gap-2');
                            textDiv.append($('<div>').addClass('text-xs font-medium text-white p-1 rounded bg-yellow-700').text(startTime));
                            textDiv.append($('<div>').addClass('text-xs font-medium').text(endTime));
                            taskDiv.append(textDiv);
                            taskDiv.append($('<div>').addClass('text-sm font-semibold overflow-auto break-words mt-2').text(title));
                            taskDiv.append($('<div>').addClass('text-xs font-medium text-red-600').text('Refresh needed to enable deletion!')); // Replace with actual attribute
                            // Append task div to day div
                            dayDiv.append(taskDiv);

                            // Calculate the time difference between the current time and the end time
                            var now = new Date();
                            var endTimeDate = new Date(now.toDateString() + ' ' + endTime + ':00');
                            var timeDiff = endTimeDate - now;

                            // Schedule a notification at the end time
                            setTimeout(function() {
                                // Code to create a notification
                                var notificationText = '- New Notification: ' + title + ' Time is Done.';
                                // Increment the notification count
                                var notificationCount = $('#notification-count').text();
                                notificationCount = parseInt(notificationCount) + 1;
                                $('#notification-count').text(notificationCount);
                                // Check if there are already notifications in local storage
                                var notifications = localStorage.getItem('notifications');
                                if (notifications) {
                                    // If there are, parse them into an array
                                    notifications = JSON.parse(notifications);
                                } else {
                                    // If not, create a new array
                                    notifications = [];
                                }
                                // Add the new notification to the array
                                notifications.push(notificationText);
                                // Store the updated array in local storage
                                localStorage.setItem('notifications', JSON.stringify(notifications));
                            }, timeDiff);
                        }
                    });
                } else {
                    alert('Please fill all the fields before submitting.');
                }
            });
        });
    });
});
$(document).ready(function(){
    $('#time-management').click(function(e){
        e.preventDefault();
        $('#content').load('../PHPTimeMg/time_management.php', function() {
            $.ajax({
                url: '../PHPTimeMg/fetch-tasks.php',
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    // Group tasks by day
                    var tasksByDay = {};
                    for (var i = 0; i < data.length; i++) {
                        if (!tasksByDay[data[i]['day']]) {
                            tasksByDay[data[i]['day']] = [];
                        }
                        tasksByDay[data[i]['day']].push(data[i]);
                    }
                    // Create tasks div
                    for (var day in tasksByDay) {
                        var dayDiv = $('#'+day); // Get the div for the current day
                        for (var i = 0; i < tasksByDay[day].length; i++) {
                            var taskDiv = $('<div>').addClass('block flex-col items-start gap-2 bg-yellow-100 shadow-md hover:bg-yellow-200 cursor:pointer rounded-md p-2');
                            taskDiv.attr('data-task-id', tasksByDay[day][i]['id']); // Set the task id as a data attribute
                            var textDiv = $('<div>').addClass('flex flex-wrap items-center justify-start gap-2');
                            textDiv.append($('<div>').addClass('text-xs font-medium text-white p-1 rounded bg-yellow-700').text(tasksByDay[day][i]['start_time']));
                            textDiv.append($('<div>').addClass('text-xs font-medium').text(tasksByDay[day][i]['end_time']));
                            textDiv.append($('<div>').addClass('text-xs font-medium text-white p-1 rounded bg-gray-300 shadow-sm').text('CAT/DC'));

                            // Create delete button and append it to the text div
                            var deleteButton = $('<button>').addClass('delete-task shadow-sm ml-3 text-xs text-white font-medium bg-yellow-500 p-1 rounded').text('remove');
                            taskDiv.append(textDiv);
                            // Add 'overflow-auto' and 'break-words' classes to the title div
                            taskDiv.append($('<div>').addClass('text-sm font-semibold overflow-auto break-words mt-2').text(tasksByDay[day][i]['title']));
                            var dynamic = $('<div>').addClass('flex flex-wrap items-center justify-between gap-2');
                            dynamic.append($('<div>').addClass('text-xs text-gray-500 mt-2').text('# To be done'));
                            dynamic.append(deleteButton);
                            taskDiv.append(dynamic);
                            // Append task div to day div
                            dayDiv.append(taskDiv);
                        }
                    }
                }
            });
        });
    });
    $(document).on('click', '.delete-task', function(e){
        e.preventDefault();
        
        // Get the id of the task to be deleted
        var taskId = $(this).parent().parent().data('task-id');
        
        $.ajax({
            url: '../PHPTimeMg/delete-task.php',
            type: 'post',
            data: {
                'delete-task': 'delete-task',
                'task-id': taskId
            },
            success: function(response) {
                // Remove the task from the UI
                $('[data-task-id="' + taskId + '"]').remove();
            }
        });
    });
  });
})
</script>

<!-- profile management  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        $("#inner_navbar a").click(function() {
            // Get the text of the clicked link
            var linkText = $(this).text();

            // Update the title in the navbar
            $("#nav_title").text(linkText);
        })
        $('#profile').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading of profile data
                    console.log("Profile data loaded successfully!");
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading profile data.");
                }
            });
        });
    });
    $(document).ready(function(){
        $('#profile').click(function(e){
            e.preventDefault();
            $('#content').load('../PHPProfile/profile.php', function() {
                $.ajax({
                    url: '../PHPProfile/fetch-data.php',
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        // Create divs for username and email
                        var usernameDiv = $('<div>').addClass('text-sm text-gray-600 font-medium p-2 bg-gray-100 rounded ring-1 ring-gray-200').text('Username: ' + data[0].username);
                        var emailDiv = $('<div>').addClass('text-sm text-gray-600 font-medium p-2 bg-gray-100 rounded ring-1 ring-gray-200').text('Email: ' + data[0].email);

                        // Append divs to the username and email holders
                        $('#username-holder').empty().append(usernameDiv);
                        $('#email-holder').empty().append(emailDiv);

                        // update form ui
                        const editProfileBtn = document.getElementById('editProfileBtn');
                        const updateForm = document.getElementById('updateForm');

                        editProfileBtn.addEventListener('click', () => {
                            updateForm.classList.toggle('hidden'); // Toggle form visibility
                        });

                        // AJAX for form submission
                        $('#updateForm').on('submit', function(e) {
                            e.preventDefault();

                            // Get form data
                            var newUsername = $('#new_username').val();
                            var newEmail = $('#new_email').val();

                            // Check if fields are not empty
                            if(newUsername && newEmail) {
                                $.ajax({
                                    url: '../PHPProfile/manage-profile.php',
                                    type: 'post',
                                    data: {
                                        'update-profile': '1',
                                        'new_username': newUsername,
                                        'new_email': newEmail
                                    },
                                    success: function(response) {
                                        alert("Profile successfully updated! You may try to re-login :]"); // Alert the response from the server
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                            } else {
                                alert('Please fill in all fields.');
                            }
                        });
                    }
                });
            });
        });
    });
});
</script>

<!-- courses management  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        $('#courses').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading of profile data
                    console.log("Courses data loaded successfully!");
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading courses data.");
                }
            });
        });
    });

    // adding a course
    $(document).ready(function() {
        $("#add-course-button").click(function() {
            var form = $("#add-course-form");
            if (form.css("display") === "none") {
                form.css("display", "block");
            } else {
                form.css("display", "none");
            }
        });

        $("#course-form").submit(function(event) {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function(response) {
                    $("#message").text(response);
                    $("#add-course-form").css("display", "none");
                }
            });
        });
    });

    // post a rating
    $(document).on('click', '[id^="rate-"]', function(e){
        e.preventDefault();
        var courseId = this.id.split('-')[1]; // Get the course ID from the button ID
        var rating = $('#rating-' + courseId).val(); // Get the selected rating
        $.ajax({
            url: '../PHPCourses/rate_course.php',
            type: 'post',
            data: {
                'courseId': courseId,
                'rating': rating
            },
            success: function(response) {
                // Code to handle successful rating
                alert("Course successfully rated!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Code to handle errors
                console.error("Error rating course: " + textStatus, errorThrown);
            }
        });
    });


});
</script>

<!-- meditation management  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        $('#meditation').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading 
                    console.log("data loaded successfully!");
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading courses data.");
                }
            });
        });
    });
});

function startMeditation() {
  // Get the Alpine.js instance
  const alpineInstance = document.querySelector('[x-data]').__x;
  const stopButton =document.getElementById('stopMeditationId');
  const startButton = document.getElementById('startMeditationId');
  startButton.classList.add('hidden');
  stopButton.classList.remove('hidden');

  // Start the interval for the slide change
  alpineInstance.$data.intervalId = setInterval(() => {
    // Increment the slide, and loop back to 0 if it's the last slide
    alpineInstance.$data.slide = (alpineInstance.$data.slide + 1) % 9; // replace 9 with the number of slides
  }, 3000); // change slide every 3 seconds

  // Start the interval for the timer
  alpineInstance.$data.timerId = setInterval(() => {
    // Decrease the time by 1 second
    if (alpineInstance.$data.time > 0) {
      alpineInstance.$data.time--;
    } else {
      // If the time reaches 0, stop the interval
      clearInterval(alpineInstance.$data.timerId);
    }
  }, 1000); // decrease time every second
}

function stopMeditation() {
  // Get the Alpine.js instance
  const alpineInstance = document.querySelector('[x-data]').__x;
  const stopButton = document.getElementById('stopMeditationId');
  const startButton = document.getElementById('startMeditationId');
  stopButton.classList.add('hidden');
  startButton.classList.remove('hidden');
  // Stop the intervals
  clearInterval(alpineInstance.$data.intervalId);
  clearInterval(alpineInstance.$data.timerId);

  // Reset the timer and slide
  alpineInstance.$data.time = 15 * 60;
  alpineInstance.$data.slide = 0;
}
</script>

<!-- chat management  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        // Add a click event listener to the sidebar links
        $("#inner_navbar a").click(function() {
            // Get the text of the clicked link
            var linkText = $(this).text();

            // Update the title in the navbar
            $("#nav_title").text(linkText);
        })
        $('#chat').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading 
                    console.log("data loaded successfully!");

                    // Load and execute the JavaScript files
                    $.getScript("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js", function() {
                        
                        $.getScript("../PHPChat/chat.js", function() {
                            // ask user for name with popup prompt    
                            var name = "<?php echo $_SESSION['username']; ?>";
                                
                                // default name is 'Guest'
                                if (!name || name === ' ') {
                                name = "Guest";	
                                }
                                
                                // strip tags
                                name = name.replace(/(<([^>]+)>)/ig,"");
                                
                                // display name on page
                                // $("#name-area").html("You are: <span>" + name + "</span>");
                                
                                // kick off chat
                                var chat =  new Chat();
                                $(function() {
                                
                                    chat.getState(); 
                                    
                                    // watch textarea for key presses
                                    $("#sendie").keydown(function(event) {  
                                    
                                        var key = event.which;  
                                
                                        //all keys including return.  
                                        if (key >= 33) {
                                        
                                            var maxLength = $(this).attr("maxlength");  
                                            var length = this.value.length;  
                                            
                                            // don't allow new content if length is maxed out
                                            if (length >= maxLength) {  
                                                event.preventDefault();  
                                            }  
                                        }  
                                    });
                                    // watch textarea for release of key press
                                    $('#sendie').keyup(function(e) {	
                                                        
                                        if (e.keyCode == 13) { 
                                        
                                            var text = $(this).val();
                                            var maxLength = $(this).attr("maxlength");  
                                            var length = text.length; 
                                            
                                            // send 
                                            if (length <= maxLength + 1) { 
                                            
                                                chat.send(text, name);	
                                                $(this).val("");
                                                
                                            } else {
                                            
                                                $(this).val(text.substring(0, maxLength));
                                                
                                            }	
                                        }
                                    });
                                    // Call updateChat every 1 second
                                    setInterval(function(){ chat.update(); }, 1000);
    	                        });
                            });
                        });
                    } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading courses data.");
                }
            });
        });
    });
});
</script>

<!-- synchronize notification with tasks  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        // Add a click event listener to the sidebar links
        $("#inner_navbar a").click(function() {
            // Get the text of the clicked link
            var linkText = $(this).text();

            // Update the title in the navbar
            $("#nav_title").text(linkText);
        })
        $('#notification-link').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading of profile data
                    console.log("Notifications loaded successfully!");
                    // Retrieve the notifications from local storage
                    var notifications = localStorage.getItem('notifications');
                    if (notifications) {
                        // If there are notifications, parse them into an array
                        notifications = JSON.parse(notifications);
                        // Loop through the array and create a div for each notification
                        for (var i = 0; i < notifications.length; i++) {
                            var notificationDiv = $('<div>').addClass('notification ring-1 ring-gray-300 hover:bg-gray-100 rounded-xl p-2 shadow-md').text(notifications[i]);
                            $('#notifications').append(notificationDiv);
                        }
                        // Clear the notifications from local storage
                        localStorage.removeItem('notifications');
                    }
                    $('#notification-count').text('0');
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading notifications.");
                }
            });
        });
    });
});
</script>

<!-- settings  -->
<script>
document.addEventListener('DOMContentLoaded', function() {    
    $(document).ready(function(){
        $('#settings').click(function(e){
            e.preventDefault();
            $('#content').load($(this).attr('href'), function(response, status, xhr) {
                if (status === "success") {
                    // Code to handle successful loading of profile data
                    console.log("Admin data loaded successfully!");
                } else {
                    // Code to handle errors (e.g., display an error message)
                    console.error("Error loading admin data.");
                }
            });
        });
    });
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- sidebar -->
        <aside class="w-48 bg-white shadow-2xl">
          <div class="mb-8">
            <div class="p-4 pb-0">
                <img width="120" src="../StaticMeditation/assets/StudyHubLogo.png" alt="StudyHub">
            </div>
          </div>
          <nav id="sidebar">
            <a 
                href="../PHPAdmin/administration.php"
                id="admin"
                class="flex items-center text-gray-400 font-medium text-sm space-x-3 p-3 hover:text-white bg-white hover:bg-purple-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                </svg>
              <span>Administration</span>
            </a>
            <a 
                id="annonce"
                href="../PHPAnnonce/annonce.php" 
                class="flex items-center text-gray-400 font-medium text-sm space-x-3 p-3 hover:text-white bg-white hover:bg-purple-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M16.881 4.345A23.112 23.112 0 0 1 8.25 6H7.5a5.25 5.25 0 0 0-.88 10.427 21.593 21.593 0 0 0 1.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.593.772-2.468a17.116 17.116 0 0 1-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0 0 18 11.25c0-2.414-.393-4.735-1.119-6.905ZM18.26 3.74a23.22 23.22 0 0 1 1.24 7.51 23.22 23.22 0 0 1-1.41 7.992.75.75 0 1 0 1.409.516 24.555 24.555 0 0 0 1.415-6.43 2.992 2.992 0 0 0 .836-2.078c0-.807-.319-1.54-.836-2.078a24.65 24.65 0 0 0-1.415-6.43.75.75 0 1 0-1.409.516c.059.16.116.321.17.483Z" />
                </svg>
              <span>Annonce</span>
            </a>
            <a 
                href="../PHPCourses/courses.php"
                id="courses" 
                class="flex items-center text-gray-400 font-medium text-sm space-x-3 p-3 hover:text-white bg-white hover:bg-purple-400"
            >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Zm1.5 0v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Z" clip-rule="evenodd" />
            </svg>
              <span>Courses</span>
            </a>
            <a 
                href="../PHPTimeMg/time-management.php"
                id="time-management" 
                class="flex items-center text-gray-400 font-medium text-sm space-x-3 p-3 hover:text-white bg-white hover:bg-purple-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                </svg>
              <span>Time Management</span>
            </a>
            <a 
                href="../PHPMeditation/meditation.php"
                id="meditation" 
                class="flex items-center font-medium text-sm space-x-3 p-3 text-white bg-yellow-400 hover:bg-yellow-500"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="h-5 w-5"
              >
                <path d="m6 15-4-4 6.75-6.77a7.79 7.79 0 0 1 11 11L13 22l-4-4 6.39-6.36a2.14 2.14 0 0 0-3-3L6 15"></path>
                <path d="m5 8 4 4"></path>
                <path d="m12 15 4 4"></path>
              </svg>
              <span>Meditation</span>
            </a>
            <a
                id="settings"
                href="../PHPSettings/settings.php" 
                class="flex items-center text-gray-400 font-medium text-sm space-x-3 p-3 hover:text-white bg-white hover:bg-purple-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                </svg>
              <span>Settings</span>
            </a>
          </nav>
        </aside>
        <main class="flex-1 p-8">
          <!-- navbar -->
          <div class="shadow-md rounded-3xl">
          <nav class="flex items-center justify-evenly px-4 rounded-3xl h-16 shadow-xl">
            <div class="text-2xl text-purple-400 font-medium ml-2" id="nav_title"></div>
            <div class="flex items-center justify-between p-1 w-1/2 rounded-lg bg-gray-100 dark:bg-gray-800 shadow-inner px-2">
              <input
                class="flex rounded-md border border-none focus:outline-none text-md p-4 ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-transparent h-8 peer placeholder-gray-400 placeholder-opacity-50 dark:placeholder-gray-500 dark:placeholder-opacity-50"
                placeholder="Search"
                type="search"
              />
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="text-gray-400"
              >
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
              </svg>
            </div>
            <div class="flex items-center justify-end gap-2" id="inner_navbar">
              <button class="bg-gray-200 text-purple-400 p-2 rounded-full inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
                <a 
                    href="../PHPProfile/profile.php" 
                    id="profile"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only" class="navLink">Profile</span>
                </a>
              </button>
              <button class="relative bg-gray-200 text-purple-400 p-2 rounded-full inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
                <a 
                    href="../PHPNotification/notification.php"
                    id="notification-link"
                >
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="h-5 w-5"
                    >
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                    </svg>
                    <span class="sr-only" class="navLink">Notifications</span>
                    <span id="notification-count" class="absolute top-0 right-0 inline-block w-5 h-5 text-xs bg-red-500 text-white rounded-full text-center">0</span>
                </a>
            </button>
              <button class="bg-gray-200 text-purple-400 p-2 rounded-full inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
                <a 
                    href="../PHPChat/chat.php" 
                    id="chat"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.721 6.721 0 0 0 3.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 0 1-.814 1.686.75.75 0 0 0 .44 1.223ZM8.25 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only" class="navLink">Chat</span>
                </a>
              </button>
              <form method="post" action="" class="p-0 m-0 box-border">
                <button 
                    type="submit"
                    name="logout"
                    class="bg-gray-200 text-purple-400 p-2 rounded-full inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="h-5 w-5"
                    >
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" x2="9" y1="12" y2="12"></line>
                    </svg>
                    <span class="sr-only">Log out</span>
                </button>
              </form>
            </div>
          </nav>
          </div>
          <!-- main content -->
          <div id="content">
            <!-- dynamic navigation content -->
          </div>
        </main>
      </div>
      <input type="hidden" id="current_username" value="<?php echo $_SESSION['username']; ?>">
    <!-- scripts -->
</body>
</html>



