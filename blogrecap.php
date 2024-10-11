<?php
include('pdo.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogpost = $_POST['blog'];
    if (empty($blogpost)) {
        echo 'Text field is empty.';
    } else {
        $stmt = $conn->prepare("INSERT INTO blog_posts (content) VALUES(?)");
        $stmt->bind_param("s", $blogpost);

        if ($stmt->execute()) {
            $_SESSION['blogpost'] = true;
            echo 'Blog posted!';
        } else {
            echo 'error: ' . $stmt->error;
        }
        $stmt->close();
    }
}

$sql = "SELECT content, created_at FROM blog_posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if (isset($_GET['delete']) && $_GET['delete'] == '1') {
    unset($_SESSION['blog']);
    $_SESSION['blogpost'] = false;
    echo 'Blog deleted!';
}

$edit_mode = isset($_GET['edit']) && $_GET['edit'] == '1';
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
        <label>Create Post</label>
        <br>
        <textarea name="blog"><?php echo isset($_SESSION['blog']) && $edit_mode ? $_SESSION['blog'] : ''; ?></textarea>
        <br>
        <input type="submit" value="<?php echo $edit_mode ? 'Update Post' : 'Submit'; ?>" name="post">
    </form>

    <div>
        <h1>Blog Post Section</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div>
                    <p><?php echo htmlspecialchars($row['content']); ?></p>
                    <small>Posted on: <?php echo $row['created_at']; ?></small>
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
// Close the connection
mysqli_close($conn);
?>