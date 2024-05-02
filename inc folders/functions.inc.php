<?php

//file containing validation functions
function emptyInputSignup($name, $email, $username, $password, $passwordrepeat) { // function to check if input boxes are empty, will return an error if any of them are
    $result = false;
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($passwordrepeat)) { //checking if any of the entered boxes are empty
        $result = true;
    }
    else{
        $result = false;
    }
    return  $result;
}
function invalidUsername($username) { // function to check if username input contains valid characters
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { //checking if the username entered contains the following characters
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}

function invalidEmail($email) { // function to check if email entered is a valid email address
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}

function passwordMatch($password, $passwordrepeat) { // function to check if password and confirm password entered are the same
    $result = false;
    if ($password !==  $passwordrepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;

}

function usernameExists($conn, $username, $email) { // function to check if the username entered already exists within the database
    $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn); // creating a prepared statement to send to the database
    if (!mysqli_stmt_prepare( $stmt , $sql )) { // checking if there was an error with the sql code executed
        header("location: ../register.php?error=stmtfailed"); //returns the user to the register page with an error saying the connection failed
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);


    $resultData = mysqli_stmt_get_result( $stmt );

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result = false;

    }

    mysqli_stmt_close($stmt);
    return $result;
}

function createUser($conn, $name, $email, $username, $password) { // function to add the user's details to the database
    $sql = "INSERT INTO users (usersName, usersEmail, usersUsername, usersPassword) VALUES (?, ?, ?, ?) ;";
    $stmt = mysqli_stmt_init($conn); // creating a prepared statement to send to the database
    if (!mysqli_stmt_prepare( $stmt , $sql )) { // checking if there was an error with the sql code executed
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    //hashing password for extra security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPassword); //adding the entered values into the SQL statement to send
    mysqli_stmt_execute($stmt); //executes the SQL statement
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none"); //returns the user to the register page with a message about successful signup
    exit();

}

function emptyInputLogin($username, $password) { // function to check if input boxes are empty, will return an error if any of them are
    $result = false;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return  $result;
}

function loginUser($conn, $username, $password){
  $usernameExists = usernameExists($conn, $username, $username);

  if ($usernameExists === false) {
    header("location: ../login.php?error=wronglogin"); //sends the user back to the login page with an error if it can't find the username in the database
    exit();
  }

  $passwordHashed = $usernameExists["usersPassword"]; //locating the hashed password
  $checkPassword = password_verify($password, $passwordHashed); //checking if the entered password matches the hashed password in the database

  if ($checkPassword === false) {
    header("location: ../login.php?error=wronglogin"); //returns the user to the login screen if it can't detect the password
  }
  else if ($checkPassword === true) { //sends the user to the main page upon successful login
    session_start();
    $_SESSION["userid"] = $usernameExists["usersId"];
    $_SESSION["username"] = $usernameExists["usersUsername"];
    header("location: ../mainpage.php");
    exit();
  }
}
?>
