<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        echo 'email not entered';
    } elseif (empty($password)) {
        echo 'password not entered';
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        echo 'login sucessfully.';
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
    <h1>forms</h1>
    <form action="index.php" method="post">
        <label for="">email</label>
        <br>
        <input type="text" name="email" id="email">
        <br>
        <label for="">password</label>
        <br>
        <input type="text" name="password" id="password">
        <br>
        <input type="submit" value="login" name="submit">
    </form>
</body>

</html>