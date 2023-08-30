<?php
session_start();

// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamA = $_POST['team_a'];
    $teamB = $_POST['team_b'];

    $stmt = $db->prepare('INSERT INTO Matches (Status, WinnerTeam) VALUES ("Ongoing", NULL)');
    $result = $stmt->execute();

    if ($result) {
        $matchID = $db->lastInsertRowID();

        foreach ($teamA as $player) {
            $stmt = $db->prepare('INSERT INTO PlayersInMatches (MatchID, UserID, Team) VALUES (:matchID, :userID, "Team A")');
            $stmt->bindValue(':matchID', $matchID, SQLITE3_INTEGER);
            $stmt->bindValue(':userID', $player, SQLITE3_TEXT);
            $stmt->execute();
        }

        foreach ($teamB as $player) {
            $stmt = $db->prepare('INSERT INTO PlayersInMatches (MatchID, UserID, Team) VALUES (:matchID, :userID, "Team B")');
            $stmt->bindValue(':matchID', $matchID, SQLITE3_INTEGER);
            $stmt->bindValue(':userID', $player, SQLITE3_TEXT);
            $stmt->execute();
        }

        echo "Match created successfully.";
    } else {
        echo "Error creating match.";
    }
}
?>
