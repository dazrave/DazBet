<?php
session_start();

// Include database connection
include '../backend/db_connection.php';

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $result = $db->query('SELECT Username FROM Users');

    $usernames = [];
    while ($row = $result->fetchArray()) {
        $usernames[] = $row['Username'];
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Add Match</title>
</head>
<body>
    <form action="../backend/add-match.php" method="post">
        <h2>Team A</h2>
        <ul>
        <?php
        foreach ($usernames as $username) {
            echo '<li><label><input type="checkbox" name="team_a[]" value="' . $username . '"> ' . $username . '</label></li>';
        }
        ?>
        </ul>
        
        <h2>Team B</h2>
        <ul>
        <?php
        foreach ($usernames as $username) {
            echo '<li><label><input type="checkbox" name="team_b[]" value="' . $username . '"> ' . $username . '</label></li>';
        }
        ?>
        </ul>
        
        <input type="submit" value="Create Match">
    </form>
</body>
</html>
