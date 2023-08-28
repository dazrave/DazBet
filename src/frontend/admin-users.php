<?php
session_start();

// Check if user is logged in and is 'Darren'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $db = new SQLite3('/var/www/html/main.db');
    $result = $db->query('SELECT Username FROM Users');

    $usernames = [];
    while ($row = $result->fetchArray()) {
        $usernames[] = $row['Username'];
    }
} else {
    header("Location: index.php"); // Redirect if not logged in as 'Darren'
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
    <?php if (isset($usernames)): ?>
        <ul>
            <?php foreach ($usernames as $username): ?>
                <li><?php echo $username; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
