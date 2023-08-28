<?php
session_start();

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $db = new SQLite3('/var/www/html/main.db');

    // Get all matches and players
    $query = 'SELECT Matches.MatchID, Matches.Status, Matches.WinnerTeam, PlayersInMatches.UserID, PlayersInMatches.Team FROM Matches 
              LEFT JOIN PlayersInMatches ON Matches.MatchID = PlayersInMatches.MatchID 
              ORDER BY Matches.MatchID';
    $result = $db->query($query);

    $matches = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $matchID = $row['MatchID'];
        if (!isset($matches[$matchID])) {
            $matches[$matchID] = [
                'Status' => $row['Status'],
                'WinnerTeam' => $row['WinnerTeam'],
                'Players' => []
            ];
        }
        if ($row['UserID']) {
            $matches[$matchID]['Players'][] = [
                'UserID' => $row['UserID'],
                'Team' => $row['Team']
            ];
        }
    }
} else {
    header("Location: index.php"); // Redirect if not logged in as 'DazRave'
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Matches</title>
</head>
<body>
    <h1>Admin Matches</h1>
    <?php if (!empty($matches)): ?>
        <ul>
            <?php foreach ($matches as $matchID => $match): ?>
                <li>Match ID: <?php echo $matchID; ?>, Status: <?php echo $match['Status']; ?>, Winner: <?php echo $match['WinnerTeam']; ?></li>
                <ul>
                    <?php foreach ($match['Players'] as $player): ?>
                        <li>Player ID: <?php echo $player['UserID']; ?>, Team: <?php echo $player['Team']; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No matches found.</p>
    <?php endif; ?>

    <p><a href="admin.php">Back to Admin</a></p>
</body>
</html>
