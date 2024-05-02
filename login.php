<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="loginstyle.css">

    </head>

    <body>
        <div class="wrapper">
            <form action="inc folders/login.inc.php" method="post">
                <h1>Password Manager Login</h1>

                <div class="input-box">
                    <input type="text" name="username" placeholder="Username/Email">
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button type="submit" class="btn" name="submit">Login</button>

                <div class="register-link">
                    <p>Don't have an account? <a href='register.php'>Register here!</a></p>
                </div>
            </form>
    </div>

    <?php

    if (isset($_GET["error"])){
      if ($_GET["error"] == "emptyinput") {
        echo "<script>alert('You have not filled in all fields.');</script>";
      }
      else if ($_GET["error"] == "wronglogin") {
        echo "<script>alert('Incorrect information entered.');</script>";
      }
    }
     ?>

    </body>
</html>
