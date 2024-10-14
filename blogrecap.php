<?php
include('pdo.php');
session_start();

$edit_mode = false;
$current_content = '';


if (isset($_GET['edit']) && isset($_GET['id'])) {
    $edit_mode = true;
    $id = (int)$_GET['id'];


    $stmt = $conn->prepare("SELECT content FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($current_content);
    $stmt->fetch();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogpost = $_POST['blog'];
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if (empty($blogpost)) {
        echo 'Text field is empty.';
    } else {
        if ($edit_mode && $id > 0) {

            $stmt = $conn->prepare("UPDATE blog_posts SET content = ? WHERE id = ?");
            $stmt->bind_param("si", $blogpost, $id);
            if ($stmt->execute()) {
                echo 'Blog updated!';
            } else {
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {

            $stmt = $conn->prepare("INSERT INTO blog_posts (content) VALUES(?)");
            $stmt->bind_param("s", $blogpost);
            if ($stmt->execute()) {
                echo 'Blog posted!';
            } else {
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        }
        header("Location: blogrecap.php");
        exit;
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('DELETE FROM blog_posts WHERE id = ?');

    if ($stmt->execute([$id])) {
        $_SESSION['blogpost'] = false;
        echo 'Blog deleted!';
    } else {
        echo 'Error deleting blog: ' . $stmt->error;
    }
    $stmt->close();
}


$sql = "SELECT id, content, created_at FROM blog_posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Recap</title>
</head>

<body>
    <h1>Blog Recap</h1>
    <form action="blogrecap.php" method="post">
        <label><?php echo $edit_mode ? 'Edit Post' : 'Create Post'; ?></label>
        <br>
        <textarea name="blog"><?php echo htmlspecialchars($current_content); ?></textarea>
        <br>
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>
        <input type="submit" value="<?php echo $edit_mode ? 'Update Post' : 'Submit'; ?>">
    </form>

    <div>
        <h1>Blog Post Section</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div>
                    <p><?php echo htmlspecialchars($row['content']); ?></p>
                    <small>Posted on: <?php echo $row['created_at']; ?></small>
                    <a href="blogrecap.php?id=<?php echo $row['id']; ?>">Remove Post</a>
                    <a href="blogrecap.php?edit=&id=<?php echo $row['id']; ?>">Edit Post</a>
                    <hr>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No blog post yet</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php

mysqli_close($conn);
?>