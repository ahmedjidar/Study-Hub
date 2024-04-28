<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
      <h2 class="text-lg text-gray-700 font-bold mb-4">Your Profile</h2>

      <!-- Display user data (read-only) -->
      <div class="mb-4" id="username-holder"></div>
      <div class="mb-4" id="email-holder"></div>

      <!-- Edit button to toggle form visibility -->
      <button id="editProfileBtn" class=" bg-gray-500 text-sm font-medium text-white px-3 py-2 rounded hover:bg-slate-600">
          Edit Profile
      </button>

      <!-- Form for updating user data (initially hidden) -->
      <form id="updateForm" method="post" class="hidden mt-2">
          <div class="mb-4">
              <label for="new_username" class="block text-sm font-medium text-gray-700">New Username</label>
              <input type="text" id="new_username" name="new_username" placeholder="Enter new username"
                    class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-purple-200">
          </div>
          <div class="mb-4">
              <label for="new_email" class="block text-sm font-medium text-gray-700">New Email</label>
              <input type="email" id="new_email" name="new_email" placeholder="Enter new email"
                    class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-purple-200">
          </div>
          <button type="submit" name="update-profile" class="bg-purple-400 text-sm font-medium text-white px-3 py-2 rounded hover:bg-purple-600">
              Update
          </button>
      </form>
    </div>
  </body>
</html>