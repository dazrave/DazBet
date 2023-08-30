<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    $loggedIn = true;
    $username = $_SESSION['username'];
    
    // Fetch DazCoins from database
    $db = new SQLite3('/main.db');
    $stmt = $db->prepare('SELECT DazCoins FROM Users WHERE Username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray();
    $dazCoins = $row['DazCoins'];
} else {
    $loggedIn = false;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to DazBet</title>
</head>
<body>
    <?php if ($loggedIn): ?>
        <p>Welcome, <?php echo $username; ?>!</p>
        <p>Your DazCoins: <?php echo $dazCoins; ?></p>
        <a href="/backend/logout.php">Logout</a>
        <?php if ($username === 'DazRave'): ?>
            <a href="admin.php">Admin Panel</a>
        <?php endif; ?>
    <?php else: ?>
        <p>Welcome to DazBet</p>
        <a href="login.php">Login</a>
    <?php endif; ?>
</body>
</html>
