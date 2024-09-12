<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader if you're using Composer (optional)
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    if (empty($name)) {
        echo 'Name is not entered.';
    } elseif (empty($email)) {
        echo 'Email not entered.';
    } elseif (empty($number)) {
        echo 'Number not entered.';
    } elseif (empty($message)) {
        echo 'Message not entered.';
    } else {
        //Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'marcio.lopes451@gmail.com';                 // SMTP username
            $mail->Password   = '///';                  // SMTP password or App password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS for SSL
            $mail->Port       = 587;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('marcio_451@icloud.com');       // Add your email as recipient

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Contact Form Submission';
            $mail->Body    = "Name: $name<br>Email: $email<br>Number: $number<br>Message: $message";

            // Send the email
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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
    <h3>contact form</h3>
    <form action="contactform.php" method="post">
        <label for="">name</label>
        <br>
        <input type="text" name="name" id="name">
        <br>
        <label for="">email</label>
        <br>
        <input type="text" name="email" id="name">
        <br>
        <label for="">number</label>
        <br>
        <input type="tel" name="number" id="name">
        <br>
        <label for="">message</label>
        <br>
        <textarea name="message" id=""></textarea>
        <br>
        <input type="submit" value="send message" name="submit">
    </form>
</body>

</html>