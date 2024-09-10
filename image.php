<?php
session_start();

// Ensure gallery is set
if (!isset($_SESSION['gallery'])) {
    $_SESSION['gallery'] = [];
}

// Check if a file has been uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'php-projects/uploads/'; // Directory to store uploaded images

    // Check if uploads directory exists, otherwise create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo 'File is not an image.';
    } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo 'Only JPG, JPEG, PNG, and GIF files are allowed.';
    } else {
        // Try to move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $_SESSION['gallery'][] = $uploadFile; // Save the path to the session
            echo 'Image successfully uploaded.';
        } else {
            echo 'Error uploading the image.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>

<body>
    <h4>Image Upload</h4>
    <form action="image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <br>
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <div>
        <?php if (!empty($_SESSION['gallery'])): ?>
            <h4>Gallery:</h4>
            <?php foreach ($_SESSION['gallery'] as $index => $img): ?>
                <img src="<?php echo $img ?>" alt="Image <?php echo $index ?>" style="max-width: 300px; margin: 10px;">
            <?php endforeach; ?>
        <?php else: ?>
            <h4>No images in gallery...</h4>
        <?php endif; ?>
    </div>
</body>

</html>