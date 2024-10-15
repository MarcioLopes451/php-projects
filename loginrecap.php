<?php
include('pdo.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        echo 'username not field.';
    } elseif (empty($password)) {
        echo 'Password not field.';
    } else {
        $stmt = $conn->prepare('INSERT INTO user (username, pass) values (?, ?) ');
        $stmt->bind_param('ss', $username, $password);
        if ($stmt->execute()) {
            echo 'Login successfully';
        } else {
            echo 'Error: ' . $stmt->error;
        }
        $stmt->close();
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
    <h1>login recap</h1>
    <?php if (isset($_SESSION['login']) && isset($_SESSION['login']) === true): ?>
        <p>hello <?php echo $_SESSION['username'] ?></p>
        <form action="loginrecap.php" method="post">

            <input type="submit" value="log Out" name="logOut">
        </form>
    <?php else: ?>
        <form action="loginrecap.php" method="post">
            <label for="">username</label><br>
            <input type="text" name="username" id=""><br>
            <label for="">password</label><br>
            <input type="password" name="password" id=""><br>
            <input type="submit" value="login">
        </form>
    <?php endif; ?>
</body>

</html>