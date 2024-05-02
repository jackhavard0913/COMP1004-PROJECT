<?php

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $password, $passwordrepeat) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (invalidUsername($username) !== false) {
        header("location: ../register.php?error=invalidusername");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }
    if (passwordMatch($password, $passwordrepeat) !== false) {
        header("location: ../register.php?error=passwordsdontmatch");
        exit();
    }
    if (usernameExists($conn, $username, $email) !== false) {
        header("location: ../register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $password);


}

else{
    header("location: ../register.php");
    exit();
}

?>
