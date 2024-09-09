<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $post = $_POST['post'];

    if (empty($title)) {
        echo 'title not entered.';
    } elseif (empty($post)) {
        echo 'post not entered.';
    } else {
        if (isset($_POST['edit_mode']) && $_POST['edit_mode'] == '1') {
            $_SESSION['title'] = $title;
            $_SESSION['post'] = $post;
            echo 'Post successfully edited.';
        } else {

            $_SESSION['title'] = $title;
            $_SESSION['post'] = $post;
            $_SESSION['posts'] = true;
            echo 'post successfully submitted.';
        }
    }
}
if (isset($_GET['edit']) && $_GET['edit'] == '1') {
    $edit_mode = true;
} else {
    $edit_mode = false;
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
    <h3>Blog</h3>

    <div>
        <form action="blog.php" method="post">
            <label for="">title</label>
            <br>
            <input type="text" name="title" id="title" value="<?php echo isset($_SESSION['title']) && $edit_mode ? $_SESSION['title'] : ''; ?>">
            <br>
            <label for="">post</label>
            <br>
            <textarea name="post" id=""><?php echo isset($_SESSION['post']) && $edit_mode ? $_SESSION['post'] : ''; ?></textarea>
            <br>
            <input type="hidden" name="edit_mode" value="<?php echo $edit_mode ? '1' : '0'; ?>">
            <input type="submit" value="<?php echo $edit_mode ? 'Update Post' : 'Submit'; ?>" name="submit">
        </form>
    </div>

    <div>
        <?php if (isset($_SESSION['posts']) && isset($_SESSION['posts']) === true): ?>
            <div>
                <h4>posts lists</h4>
                <div>
                    <h4><?php echo $_SESSION['title'] ?></h4>
                    <p><?php echo $_SESSION['post'] ?></p>
                </div>
                <a href="blog.php?edit=1">Edit Post</a>
            </div>
        <?php else: ?>
            <h4>no posts</h4>
    </div>
<?php endif; ?>
</body>

</html>