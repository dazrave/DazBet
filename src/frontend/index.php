<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    $loggedIn = true;
    $username = $_SESSION['username'];
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
        <a href="backend/login.php?logout">Logout</a>
    <?php else: ?>
        <p>Welcome to DazBet</p>
        <a href="backend/login.html">Login</a>
    <?php endif; ?>
</body>
</html>
