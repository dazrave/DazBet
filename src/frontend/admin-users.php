<?php
session_start();

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $db = new SQLite3('/main.db');
    $result = $db->query('SELECT Username, DazCoins FROM Users');

    $userCoins = [];
    while ($row = $result->fetchArray()) {
        $userCoins[$row['Username']] = $row['DazCoins'];
    }
} else {
    header("Location: index.php"); // Redirect if not logged in as 'DazRave'
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Users</title>
</head>
<body>
    <h1>Admin Users</h1>
    <?php if (!empty($userCoins)): ?>
        <ul>
            <?php foreach ($userCoins as $username => $coins): ?>
                <li><?php echo "{$username} - DazCoins: {$coins}"; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="admin.php">Back to Admin</a></p>
</body>
</html>
