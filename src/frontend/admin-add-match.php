<form action="../backend/add-match.php" method="post">
    <h2>Team A</h2>
    <?php
    if (isset($userCoins)) {
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
    if (isset($userCoins)) {
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
