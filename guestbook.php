<?php
session_start();

class Guest
{
    public $name;
    public $email;
    public $comment;

    public function __construct($name, $email, $comment)
    {
        $this->name = $name;
        $this->email = $email;
        $this->comment = $comment;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    if (empty($name)) {
        echo 'Name is not entered.';
    } elseif (empty($email)) {
        echo 'Email is not entered.';
    } elseif (empty($comment)) {
        echo 'comment is not entered.';
    } else {
        $guest = new Guest($name, $email, $comment);

        if (!isset($_SESSION['guest'])) {
            $_SESSION['guest'] = [];
        }
        $_SESSION['guest'][] = $guest;
        echo 'Guestlist Submitted!';
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
    <h4>Guestbook</h4>

    <form action="guestbook.php" method="post">
        <label>Name</label>
        <br>
        <input type="text" name="name" id="name">
        <br>
        <label>Email</label>
        <br>
        <input type="text" name="email" id="email">
        <br>
        <label>Comment</label>
        <br>
        <textarea name="comment" id="comment"></textarea>
        <br>
        <input type="submit" value="Submit" name="submit">
        <input type="submit" value="Reset" name="reset">
    </form>

    <div>
        <?php if (!empty($_SESSION['guest'])): ?>
            <?php foreach ($_SESSION['guest'] as $index => $guests): ?>
                <h4><?php echo $guest->name ?></h4>
                <h4><?php echo $guest->email ?></h4>
                <p><?php echo $guest->comment ?></p>
                <a href="guestbook.php?delete=<?php echo $index; ?>">delete guest</a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
if (isset($_POST['reset'])) {
    $name = $email = $comment = '';
    echo 'Form Reset!';
}

if (isset($_GET['delete'])) {
    $guestIndex = $_GET['delete'];

    if (isset($_SESSION['guest'][$guestIndex])) {
        unset($_SESSION['guest'][$guestIndex]);
        echo 'Deleted Guest.';
        $_SESSION['guest'] = array_values($_SESSION['guest']);
    }

    header('location: guestbook.php');
    exit;
}
?>