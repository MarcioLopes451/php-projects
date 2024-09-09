<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        echo 'No registered user found. Please register first.';
    } elseif (empty($username)) {
        echo 'Username not entered.';
    } elseif (empty($password)) {
        echo 'Password not entered.';
    } elseif ($username !== $_SESSION['username']) {
        echo 'Username does not exist.';
    } elseif ($password !== $_SESSION['password']) {
        // For hashed password, use password_verify() like this:
        // } elseif (!password_verify($password, $_SESSION['password'])) {
        echo 'Incorrect password.';
    } else {
        $_SESSION['login'] = true;
        echo 'Login successful.';
    }

    if (isset($_POST['logout'])) {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        header('Location: login.php'); // Redirect to login page
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
    <?php if (isset($_SESSION['login']) && isset($_SESSION['login']) === true): ?>
        <h3>login successful</h3>
        <p><?php echo $_SESSION['username'] ?></p>
        <form action="login.php" method="post">
            <input type="submit" value="logout" name="logout">
        </form>
    <?php else: ?>
        <h4>login form</h4>
        <form action="login.php" method="post">
            <label for="">username</label>
            <br>
            <input type="text" name="username" id="">
            <br>
            <label for="">password</label>
            <br>
            <input type="password" name="password" id="">
            <br>
            <input type="submit" value="login">
        </form>

        <div>
            <p>don't have a account?</p>
            <a href="register.php">create account</a>
        </div>
    <?php endif; ?>
</body>

</html>