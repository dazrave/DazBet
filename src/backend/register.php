<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password (add more validation if needed)
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $db = new SQLite3('/var/www/html/main.db');
        $stmt = $db->prepare('INSERT INTO Users (Username, Password) VALUES (:username, :password)');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);

        if ($stmt->execute()) {
            // Log in the user
            $_SESSION['username'] = $username;

            // Redirect to the main page or dashboard
            header("Location: ../frontend/index.php");
            exit();
        } else {
            echo "Error registering user.";
        }
    }
}
?>
