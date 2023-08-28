<?php
session_start();

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $db = new SQLite3('/var/www/html/main.db');

    // Retrieve all matches and their details
    $result = $db->query('SELECT * FROM Matches ORDER BY YourColumnName DESC'); // Replace YourColumnName

    $matches = [];
    while ($row = $result->fetchArray()) {
        $teamA = explode(', ', $row['TeamA']);
        $teamB = explode(', ', $row['TeamB']);
        $timestamp = $row['YourColumnName']; // Replace YourColumnName

        $matches[] = [
            'teamA' => $teamA,
            'teamB' => $teamB,
            'timestamp' => $timestamp
        ];
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
        <?php foreach ($matches as $match): ?>
            <h2>Match on <?php echo $match['timestamp']; ?></h2>
            <p>Team A: <?php echo implode(', ', $match['teamA']); ?></p>
            <p>Team B: <?php echo implode(', ', $match['teamB']); ?></p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No matches found.</p>
    <?php endif; ?>

    <p><a href="admin.php">Back to Admin</a></p>
</body>
</html>
