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
if (isset($_GET['delete']) && $_GET['delete'] == '1') {
    unset($_SESSION['blog']);
    $_SESSION['blogpost'] = false;
    echo 'Blog deleted!';
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
        <?php if (isset($_SESSION['blogpost']) && $_SESSION['blogpost'] == true): ?>
            <p><?php echo $_SESSION['blog']; ?> </p>
            <a href="blogrecap.php?delete=1">Delete Post</a>
        <?php else: ?>
            <p>No blog post yet</p>
        <?php endif; ?>
    </div>
</body>

</html>