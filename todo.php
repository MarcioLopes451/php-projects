<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $task = trim($_POST['task']);

    if (!empty($task)) {
        $_SESSION['tasks'][] = $task;

        $task = '';
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
    <h4>Todo List</h4>
    <form action="todo.php" method="post">
        <input type="text" name="task" id="task">
        <input type="submit" value="add task">
    </form>
    <div>
        <ul>
            <?php if (!empty($_SESSION['tasks'])): ?>
                <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                    <li><?php echo htmlspecialchars($task); ?> <a href="todo.php?delete=<?php echo $index; ?>">Delete</a></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No tasks yet!</li>
            <?php endif; ?>
        </ul>
    </div>
</body>

</html>

<?php

if (isset($_GET['delete'])) {
    $taskIndex = $_GET['delete'];

    if (isset($_SESSION['tasks'][$taskIndex])) {
        unset($_SESSION['tasks'][$taskIndex]);

        $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    }

    header('location: todo.php');
    exit;
}
?>