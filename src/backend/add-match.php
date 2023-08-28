<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamA = $_POST['team_a'];
    $teamB = $_POST['team_b'];

    // Connect to the database
    $db = new SQLite3('/var/www/html/main.db');

    // Insert match into the database
    $stmt = $db->prepare('INSERT INTO Matches (TeamA, TeamB, Timestamp) VALUES (:teamA, :teamB, datetime("now"))');
    $stmt->bindValue(':teamA', implode(', ', $teamA), SQLITE3_TEXT);
    $stmt->bindValue(':teamB', implode(', ', $teamB), SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "Match created successfully.";
    } else {
        echo "Error creating match.";
    }
}
?>
