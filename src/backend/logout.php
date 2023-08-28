<?php
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect the user back to the login page or any other page you desire
header("Location: /index.php");
exit();
?>
