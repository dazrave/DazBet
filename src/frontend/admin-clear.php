<?php
session_start();

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $isAdmin = true;
} else {
    $isAdmin = false;
}

// Handle clearing matches and users
if ($isAdmin && isset($_POST['clear'])) {
    // Logic to clear matches and users from the database
    // Implement your clearing logic here

    echo "Matches and users cleared.";
}

// Handle creating random users
if ($isAdmin && isset($_POST['create_random_users'])) {
    // Logic to create 10 random users for testing
    // Implement your random user creation logic here

    echo "10 random users created for testing.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Clear</title>
</head>
<body>
    <h1>Admin Clear</h1>
    
    <?php if ($isAdmin): ?>
        <form action="admin-clear.php" method="post">
            <input type="submit" name="clear" value="Clear Matches and Users">
        </form>
        
        <form action="admin-clear.php" method="post">
            <input type="submit" name="create_random_users" value="Create 10 Random Users">
        </form>
    <?php else: ?>
        <p>You don't have permission to access this page.</p>
    <?php endif; ?>
    
    <p><a href="admin.php">Back to Admin</a></p>
</body>
</html>
