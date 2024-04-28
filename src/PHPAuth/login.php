<?php
require_once 'config.php';

// Start session
session_start();

// Login
if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = $_POST['password'];
  $result = $db->query("SELECT * FROM users WHERE username = '".$username."'");
  if($result->num_rows > 0){
      $user = $result->fetch_assoc();
      if(password_verify($password, $user['password'])){
          $_SESSION['email'] = $user['email'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['user_id'] = $user['id'];
          echo "User Login Success";
          header("Location: ../PHPDashboard/dashboard.php");
      }else{
          echo "<div class='alert alert-danger'>User Login Failed</div>";
      }
  }else{
      echo "<div class='alert alert-danger'>User Login Failed</div>";
  }
}
?>

<style>
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}

</style>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
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
      <div class="w-[560px] h-[520px] bg-white rounded-xl">
        <form method="post" action="" class="flex flex-col justify-center m-10 gap-8">
          <h1 class="font-Nunito text-5xl font-bold mb-[17px] self-center">
            Login
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
          <a
            href="#"
            class="forgot-password font-Poppins font-medium text-sm self-end mr-[60px]"
          >
            Forgot password ?
          </a>
          <a
            href="./registration.php"
            class="forgot-password font-Poppins font-medium text-sm self-end mr-[60px]"
          >
            Create an account
          </a>
          <button
            type="submit"
            name="login"
            class="submit-button font-Poppins font-semibold text-xl self-center text-white bg-gradient-to-br hover:bg-gradient-to-r from-[#a78ec7] to-[#60D3DD]"
          >
            Login
          </button>
        </form>
      </div>
    </section>
  </body>
</html>

