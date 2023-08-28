<?php
session_start();

// Check if user is logged in and is 'DazRave'
if (isset($_SESSION['username']) && $_SESSION['username'] === 'DazRave') {
    $db = new SQLite3('/var/www/html/main.db');
    $result = $db->query('SELECT Username, DazCoins FROM Users');

    $userCoins = [];
    while ($row = $result->fetchArray()) {
        $userCoins[$row['Username']] = $row['DazCoins'];
    }

    // Include test users
    $testUsers = [
        'User1' => 100, // Example DazCoins amount
        'User2' => 100, // Example DazCoins amount
        'User3' => 100, // Example DazCoins amount
    };

    $userCoins = array_merge($userCoins, $testUsers);
} else {
    header("Location: index.php"); // Redirect if not logged in as 'DazRave'
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
        <?php
        if (!empty($userCoins)) {
            echo '<ul>';
            foreach ($userCoins as $username => $coins) {
                echo '<li>';
                echo '<label>';
                echo '<input type="checkbox" name="team_a[]" value="' . $username . '"> ' . $username;
                echo '</label>';
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>
        
        <h2>Team B</h2>
        <?php
        if (!empty($userCoins)) {
            echo '<ul>';
            foreach ($userCoins as $username => $coins) {
                echo '<li>';
                echo '<label>';
                echo '<input type="checkbox" name="team_b[]" value="' . $username . '"> ' . $username;
                echo '</label>';
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>
        
        <input type="submit" value="Create Match">
    </form>
</body>
</html>
