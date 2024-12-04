<?php
// Start the session if it is not already started
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Start a new session to store the logout message
session_start();
$_SESSION['logoutMessage'] = "You have successfully logged out.";

// Redirect to the index page
header("Location: index.php");
exit();
?>
