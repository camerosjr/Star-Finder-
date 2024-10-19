<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Signup</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div class="container">
    <div class="form-box box">


      <header>Admin Sign Up</header>
      <hr>

      <form action="signup_admin.php" method="POST">


        <div class="form-box">

          <?php

          session_start();

          include "connection.php";

          if (isset($_POST['register'])) {

            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];

            $check = "SELECT * FROM admin WHERE email='$email'";
            $res = mysqli_query($conn, $check);

            $passwd = password_hash($pass, PASSWORD_DEFAULT);

            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'>
        <p>This email is already in use. Please choose another one.</p>
        </div><br>";

              echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";


            } else {

              if ($pass === $cpass) {

                $sql = "INSERT INTO admin (username, email, password) VALUES ('$name', '$email', '$passwd')";
                $result = mysqli_query($conn, $sql);

                if ($result) {

                  echo "<div class='message'>
      <p>You have registered successfully!</p>
      </div><br>";

                  echo "<a href='login_admin.php'><button class='btn'>Login Now</button></a>";

                } else {
                  echo "<div class='message'>
        <p>Registration failed. Please try again later.</p>
        </div><br>";

                  echo "<a href='signup_admin.php'><button class='btn'>Go Back</button></a>";
                }

              } else {
                echo "<div class='message'>
      <p>Passwords do not match.</p>
      </div><br>";

                echo "<a href='signup_admin.php'><button class='btn'>Go Back</button></a>";
              }
            }
          } else {

            ?>

            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username" name="username" required>
            </div>

            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required>
              <i class="fa fa-eye icon toggle"></i>
            </div>

            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="Confirm Password" name="cpass" required>
              <i class="fa fa-eye icon"></i>
            </div>

          </div>


          <center><input type="submit" name="register" id="submit" value="Signup" class="btn"></center>


          <div class="links">
            Already have an account? <a href="login_admin.php">Sign in Now</a>
          </div>

        </form>
      </div>
      <?php
          }
          ?>
  </div>

  <script>
    const toggle = document.querySelector(".toggle"),
      input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        input.type = "password";
      }
    })
  </script>
</body>

</html>
