<?php
session_start();

// Function to create a user
function createUser($username, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $db = new SQLite3('/var/www/html/main.db');
    $stmt = $db->prepare('INSERT INTO Users (Username, Password) VALUES (:username, :password)');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);

    return $stmt->execute();
}

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
    // Create 10 random users for testing
    $testUserPrefix = 'testuser';
    for ($i = 1; $i <= 10; $i++) {
        $username = $testUserPrefix . $i;
        $password = 'password'; // Change this to the desired password

        createUser($username, $password);
    }

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
