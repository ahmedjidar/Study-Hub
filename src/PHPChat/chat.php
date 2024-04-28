<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit;
}

include '../PHPAuth/config.php';

// Fetch users from the database
$result = $db->query("SELECT * FROM users");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Messages</title>
</head>
<body>
  <div class="shadow-md rounded-3xl">
      <div class="flex items-center mt-6 shadow-lg rounded-3xl">
            <aside class="w-64 overflow-y-scroll max-h-screen bg-gray-100 rounded-l-2xl">
              <div class=" sticky top-0 z-20 flex items-center justify-between px-4 space-x-2 font-bold text-white bg-purple-400 h-16">
                <span>Instant Messaging <br><span class="text-xs font-light mt-1">Messages are visible to all</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
              </div>
              <nav class="mt-5">
                <ul class="pb-2">
                  <?php while($row = $result->fetch_assoc()): ?>
                  <li class="flex items-center space-x-2 p-2 rounded-md text-gray-700 hover:bg-purple-100" data-user-id="<?php echo $row['id']; ?>">
                    <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                      <img class="aspect-square h-full w-full object-cover" alt="<?php echo $row['username']; ?>" src="https://mhcid.washington.edu/wp-content/uploads/2021/12/placeholder-user-1139x1536.jpg" />
                    </span>
                    <span><?php echo $row['username']; ?></span>
                  </li>
                  <?php endwhile; ?>
                </ul>
              </nav>
            </aside>
            <main class="flex-1 h-screen rounded-2xl overflow-x-hidden">
              <div 
                id="page-wrap"
                class="flex flex-col h-full w-full"
              >
                <div class="w-full flex-1 flex justify-evenly rounded p-2 space-y-4 overflow-y-auto mb-4">
                  <div class="flex flex-col items-start justify-start space-x-2 rounded min-w-full" id="chat-wrap">
                    <div id="chat-area" class="rounded p-2 w-full">
                    </div>
                  </div>
                </div>
                <form 
                  id="send-message-area"
                  class="w-full"
                >
                <textarea
                  id="sendie"
                  placeholder="Type your message..."
                  maxlength="1000"
                  class="w-full p-2 outline-none border-none resize-none bg-gray-200 shadow-md rounded"
                ></textarea>
                </form>
              </div>
            </main>
      </div>
  </div>

</body>
</html>
