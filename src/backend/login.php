<?php
session_start();

$db = new SQLite3('/path/to/main.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM Users WHERE Username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($row = $result->fetchArray()) {
        if (password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username;
            echo "Login successful";
            // Redirect to the main page or dashboard
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}
?>
