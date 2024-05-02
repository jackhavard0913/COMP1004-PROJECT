<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="registerstyle.css">
    </head>

    <body>
        <div class="wrapper">
            <form action="inc folders/register.inc.php" method="post">
                <h1>Create an account</h1>

                <div class="input-box">
                    <input type="text" name="name" placeholder="Full Name">
                </div>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username">
                </div>

                <div class="input-box">
                    <input type="text" name="email" placeholder="Email Address">
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <div class="input-box">
                    <input type="password" name="passwordrepeat" placeholder="Repeat password">
                </div>

                <button type="submit" name="submit" class="btn">Create account</button>

                <div class="return">
                    <a href='login.php'>Return to login page</a>
                </div>
            </form>
    </div>

    <?php

    if (isset($_GET["error"])){
      if ($_GET["error"] == "emptyinput") {
        echo "<script>alert('You have not filled in all fields.');</script>";
      }
      else if ($_GET["error"] == "invalidusername") {
        echo "<script>alert('You have not entered a valid username. Please try again.');</script>";
      }
      else if ($_GET["error"] == "invalidemail") {
        echo "<script>alert('You have not entered a valid email address. Please try again.');</script>";
      }
      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<script>alert('The passwords you have entered do not match. Please try again.');</script>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
      }
      else if ($_GET["error"] == "usernametaken") {
        echo "<script>alert('The username you have chose already exists. Please enter a different username.');</script>";
      }
      else if ($_GET["error"] == "none") {
        echo "<script>alert('Account successfully created!');</script>";
      }
    }
     ?>

    </body>
</html>
