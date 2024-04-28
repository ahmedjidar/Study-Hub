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
  </head>
  <body>
    <p class="text-sm text-gray-400 mt-6 mb-2">Your notifications, <span class="underline"><?php echo $_SESSION['username'] ?></span></p>
    <div id="notifications" class="flex flex-col items-start justify-center gap-4 mt-2">

    </div>
  </body>
</html>
