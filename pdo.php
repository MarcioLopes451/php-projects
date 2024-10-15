<?php
$db_server = '127.0.0.1';  // Server hostname
$db_user = 'root';         // MySQL username
$db_pass = 'Elizandra1';              // MySQL password
$db_name = 'myDB';         // Database name
$db_port = 3306;           // MySQL port number

// Try to connect to the database
try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name, $db_port);
} catch (mysqli_sql_exception $e) {
    echo 'Could not connect: ' . $e->getMessage();
    exit;
}

if ($conn) {
    '';
} else {
    echo 'Connection failed.';
}
