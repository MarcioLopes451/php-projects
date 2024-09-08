<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX PHP Calculator</title>
    <script>
        // Function to handle button clicks and send data via AJAX
        function sendCalculation(value) {
            var display = document.getElementById("number").value;

            // Create an XMLHttpRequest object
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the display with the server response
                    document.getElementById("number").value = this.responseText;
                }
            };

            // Send data to PHP via POST
            xhttp.open("POST", "calculator.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("input=" + encodeURIComponent(value) + "&number=" + encodeURIComponent(display));
        }

        // Function to clear the calculator display
        function clearDisplay() {
            document.getElementById("number").value = '';
        }
    </script>
</head>

<body>
    <h3>Calculator</h3>

    <div>
        <!-- Calculator Form -->
        <input type="text" name="number" id="number" value="" readonly>
        <br><br>
        <!-- Number and Operator Buttons -->
        <button type="button" onclick="sendCalculation('1')">1</button>
        <button type="button" onclick="sendCalculation('2')">2</button>
        <button type="button" onclick="sendCalculation('3')">3</button>
        <button type="button" onclick="sendCalculation('+')">+</button>
        <br><br>
        <button type="button" onclick="sendCalculation('4')">4</button>
        <button type="button" onclick="sendCalculation('5')">5</button>
        <button type="button" onclick="sendCalculation('6')">6</button>
        <button type="button" onclick="sendCalculation('-')">-</button>
        <br><br>
        <button type="button" onclick="sendCalculation('7')">7</button>
        <button type="button" onclick="sendCalculation('8')">8</button>
        <button type="button" onclick="sendCalculation('9')">9</button>
        <button type="button" onclick="sendCalculation('*')">x</button>
        <br><br>
        <button type="button" onclick="sendCalculation('0')">0</button>
        <button type="button" onclick="sendCalculation('/')">÷</button>
        <button type="button" onclick="sendCalculation('=')">=</button>
        <button type="button" onclick="clearDisplay()">C</button>
    </div>
</body>

</html>

<?php
session_start();

// Get the posted values
$number = isset($_POST['number']) ? $_POST['number'] : '';
$input = isset($_POST['input']) ? $_POST['input'] : '';

// Process the input (numbers, operators, clear, and equals)
if ($input == 'C') {
    $number = ''; // Clear the display
    $_SESSION['first_number'] = ''; // Reset stored values
    $_SESSION['operation'] = '';
} elseif (is_numeric($input)) {
    $number .= $input; // Append the number
} elseif (in_array($input, ['+', '-', '*', '/'])) {
    $_SESSION['first_number'] = $number; // Store the first number
    $_SESSION['operation'] = $input; // Store the operator
    $number = ''; // Reset for the next input
} elseif ($input == '=') {
    $first_number = $_SESSION['first_number'];
    $operation = $_SESSION['operation'];

    if ($operation && $first_number !== '') {
        switch ($operation) {
            case '+':
                $number = $first_number + $number;
                break;
            case '-':
                $number = $first_number - $number;
                break;
            case '*':
                $number = $first_number * $number;
                break;
            case '/':
                $number = $number != 0 ? $first_number / $number : 'Error'; // Avoid division by zero
                break;
        }
        $_SESSION['operation'] = '';
        $_SESSION['first_number'] = '';
    }
}

// Return the updated number (display) to the AJAX request
echo $number;
?>