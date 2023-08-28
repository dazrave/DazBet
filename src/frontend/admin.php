<?php
session_start();

// Check if user is logged in and is 'Darren'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $isAdmin = true;
} else {
    $isAdmin = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    
    <?php if ($isAdmin): ?>
        <ul>
            <li><a href="admin-users.php">View Registered Users</a></li>
            <!-- Add more links to other admin pages here -->
        </ul>
    <?php else: ?>
        <p>You don't have permission to access this page.</p>
    <?php endif; ?>
    
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
