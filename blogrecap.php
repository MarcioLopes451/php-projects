<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogpost = $_POST['blog'];
    if (empty($blogpost)) {
        echo 'text field is empty.';
    } else {
        $_SESSION['blog'] = $blogpost;
        $_SESSION['blogpost'] = true;
        echo 'blog posted!';
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
    <h1>blog recap</h1>
    <form action="blogrecap.php" method="post">
        <label>create post</label>
        <br>
        <textarea name="blog"></textarea>
        <br>
        <input type="submit" value="post" name="post">
    </form>

    <div>
        <h1>blog post section</h1>
        <?php if (isset($_SESSION['blogpost']) && isset($_SESSION['blogpost']) == true): ?>
            <p><?php echo $_SESSION['blog'] ?> </p>
        <?php else : ?>
            <p>no blog post yet</p>
        <?php endif; ?>
    </div>
</body>

</html>