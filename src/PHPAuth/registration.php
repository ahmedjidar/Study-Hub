<?php
require_once 'config.php';

// Start session
session_start();

// Registration
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $db->query("SELECT * FROM users WHERE email = '".$email."'");
    if($check->num_rows > 0){
        echo "Email already exists";
    } else {
        $insert = $db->query("INSERT into users (username, email, password) VALUES ('".$username."','".$email."','".$password."')");
        if($insert){
            echo "User Registration Success";
            header("Location: login.php"); 
        }else{
            echo "User Registration Failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../StaticAuth/login.css">
    <link rel="stylesheet" href="../../output.css">
  </head>
  <body>
    <section
      class="login-main h-screen w-screen flex justify-center items-center"
    >
      <div class="w-[560px] h-[540px] bg-white rounded-xl">
        <form method="post" action="" class="flex flex-col justify-center m-10 gap-8">
          <h1 class="font-Nunito text-5xl font-bold mb-[17px] self-center">
            Register
          </h1>
          <div class="flex flex-col gap-5 ml-5">
            <label class="font-Nunito text-xl font-semibold"> Username </label>
            <div class="flex input-bottom pb-[9px] max-w-[395px]">
              <img
                class="w-[21px] h-[21px]"
                src="../StaticAuth/assets/username-icon.png"
                alt="lock icon"
              />
              <input
                type="text"
                name="username"
                class="ml-[17.5px] focus:outline-none font-Poppins font-medium text-sm max-w-[300px]"
                placeholder="Type your username"
                required
              />
            </div>
          </div>
          <div class="flex flex-col gap-5 ml-5">
            <label class="font-Nunito text-xl font-semibold"> Email </label>
            <div class="flex input-bottom pb-[9px] max-w-[395px]">
              <img
                class="w-[21px] h-[21px]"
                src="../StaticAuth/assets/username-icon.png"
                alt="lock icon"
              />
              <input
                type="email"
                name="email"
                class="ml-[17.5px] focus:outline-none font-Poppins font-medium text-sm max-w-[300px]"
                placeholder="Type your email"
                required
              />
            </div>
          </div>
          <div class="flex flex-col gap-5 ml-5">
            <label class="font-Nunito text-xl font-semibold"> Password </label>
            <div class="flex input-bottom pb-[9px] max-w-[395px]">
              <img
                class="w-[17px] h-[23px]"
                src="../StaticAuth/assets/lock-icon.png"
                alt="lock icon"
              />
              <input
                name="password"
                type="password"
                class="ml-[17.5px] focus:outline-none font-Poppins font-medium text-sm max-w-[300px]"
                placeholder="Type your password"
                required
              />
            </div>
          </div>
          <button
            type="submit"
            name="register"
            class="submit-button font-Poppins font-semibold text-xl self-center text-white bg-gradient-to-br hover:bg-gradient-to-r from-[#a78ec7] to-[#60D3DD]"
          >
            Register
          </button>
        </form>
      </div>
    </section>
  </body>
</html>