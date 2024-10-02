<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
</head>

<body>
    <h2>Vote for your favorite programming language</h2>
    <form action="voting.php" method="post">
        <p>What is your favorite programming language?</p>
        <label>
            Javascript
            <input type="radio" name="vote" value="javascript" />
        </label><br>
        <label>
            C
            <input type="radio" name="vote" value="c" />
        </label><br>
        <label>
            Java
            <input type="radio" name="vote" value="java" />
        </label><br><br>
        <input type="submit" value="Vote" />
    </form>
</body>

</html>

<?php
// Simple array to store votes (in practice, you would store this in a database)
$votes = [
    "javascript" => 0,
    "c" => 0,
    "java" => 0
];

// Retrieve the current votes from a file (in this case, votes.txt)
$filename = "votes.txt";
if (file_exists($filename)) {
    $votes = json_decode(file_get_contents($filename), true);
}

// Process the vote
if (isset($_POST['vote'])) {
    $selected_language = $_POST['vote'];

    if (array_key_exists($selected_language, $votes)) {
        $votes[$selected_language]++;
    }

    // Save the updated votes back to the file
    file_put_contents($filename, json_encode($votes));
}

// Display the results
echo "<h2>Results:</h2>";
foreach ($votes as $language => $vote_count) {
    echo ucfirst($language) . ": " . $vote_count . " votes<br>";
}
?>