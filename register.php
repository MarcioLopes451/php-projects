<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        echo 'username not entered.';
    } elseif (empty($password)) {
        echo 'password not entered.';
    } else {
        //$hash = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        echo 'registration successful.';

        header('Location: login.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4>register form</h4>
    <form action="register.php" method="post">
        <label for="">username</label>
        <br>
        <input type="text" name="username" id="">
        <br>
        <label for="">password</label>
        <br>
        <input type="password" name="password" id="">
        <br>
        <input type="submit" value="register">
    </form>
    <div>
        <p>have a account?</p>
        <a href="login.php">login</a>
    </div>
</body>

</html>