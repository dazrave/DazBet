<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="../backend/login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.html">Register here</a>.</p>

    <?php
    // Here, you can include PHP logic for processing the login form.
    // For example, handling form submission, validating user credentials, etc.
    // This area is where you can integrate your PHP code.
    ?>

</body>
</html>
