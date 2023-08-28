<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamA = $_POST['team_a'];
    $teamB = $_POST['team_b'];

    // Connect to the database
    $db = new SQLite3('/var/www/html/main.db');

    // Insert match into the database
    $stmt = $db->prepare('INSERT INTO Matches (Status, WinnerTeam) VALUES ("Ongoing", NULL)');
    $result = $stmt->execute();

    if ($result) {
        $matchID = $db->lastInsertRowID(); // Get the last inserted match ID

        // Insert players into PlayersInMatches table
        foreach ($teamA as $player) {
            $stmt = $db->prepare('INSERT INTO PlayersInMatches (MatchID, UserID, Team) VALUES (:matchID, :userID, "Team A")');
            $stmt->bindValue(':matchID', $matchID, SQLITE3_INTEGER);
            $stmt->bindValue(':userID', $player, SQLITE3_INTEGER);
            $stmt->execute();
        }

        foreach ($teamB as $player) {
            $stmt = $db->prepare('INSERT INTO PlayersInMatches (MatchID, UserID, Team) VALUES (:matchID, :userID, "Team B")');
            $stmt->bindValue(':matchID', $matchID, SQLITE3_INTEGER);
            $stmt->bindValue(':userID', $player, SQLITE3_INTEGER);
            $stmt->execute();
        }

        echo "Match created successfully.";
    } else {
        echo "Error creating match.";
    }
}
?>
