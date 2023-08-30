<?php
session_start();

// Function to create a user
function createUser($username, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $db = new SQLite3('/main.db');
    $stmt = $db->prepare('INSERT INTO Users (Username, Password) VALUES (:username, :password)');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);

    return $stmt->execute();
}

// Function to clear test users
function clearTestUsers() {
    $db = new SQLite3('/main.db');
    $stmt = $db->prepare('DELETE FROM Users WHERE Username LIKE :prefix');
    $stmt->bindValue(':prefix', 'testuser%', SQLITE3_TEXT);

    return $stmt->execute();
}

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $isAdmin = true;
} else {
    $isAdmin = false;
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

// Handle clearing test users
if ($isAdmin && isset($_POST['clear_test_users'])) {
    // Clear all test users
    clearTestUsers();

    echo "Test users cleared.";
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
            <input type="submit" name="create_random_users" value="Create 10 Random Users">
        </form>

        <form action="admin-clear.php" method="post">
            <input type="submit" name="clear_test_users" value="Clear Test Users">
        </form>
        
        <form action="backend/clear-matches.php" method="post">
            <input type="submit" name="clear_matches" value="Clear Matches">
        </form>
    <?php else: ?>
        <p>You don't have permission to access this page.</p>
    <?php endif; ?>
    
    <p><a href="admin.php">Back to Admin</a></p>
</body>
</html>
