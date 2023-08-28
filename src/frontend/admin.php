<?php
session_start();

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $isAdmin = true;

    // Find all admin pages in the frontend directory
    $adminPages = array_filter(scandir('frontend'), function ($filename) {
        return preg_match('/^admin-.*\.php$/', $filename);
    });

    // Remove ".php" extension from filenames
    $adminPages = array_map(function ($filename) {
        return pathinfo($filename, PATHINFO_FILENAME);
    }, $adminPages);
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
            <?php foreach ($adminPages as $page): ?>
                <li><a href="frontend/<?php echo $page; ?>.php"><?php echo ucwords(str_replace('-', ' ', $page)); ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You don't have permission to access this page.</p>
    <?php endif; ?>
    
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
