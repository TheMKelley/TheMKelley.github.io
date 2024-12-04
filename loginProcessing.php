<?php
include("connection.php");
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_POST["submit"])) {
    $emailInput = $_POST["emailInput"];
    $passwordInput = $_POST["passwordInput"];

    // Prepare the SQL query to retrieve the user
    $query = "SELECT id, FName, password FROM user WHERE (Email = :email)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":email", $emailInput, PDO::PARAM_STR);
    $stmt->execute();
    $output = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if user exists
    if ($output) {
        // Verify the password against the hashed password
        if (password_verify($passwordInput, $output["password"])) {
            // Passwords match
            $_SESSION["userID"] = $output["id"];
            // Store first name in session
            $_SESSION["FName"] = $output["FName"];
            // Set login message
            $_SESSION['loggedInMessage'] = "You are now logged in.";
            header("location: index.php");
            exit();
        } else {
            // Passwords do not match
            header("location: login.php?err=1");
            exit();
        }
    } else {
        // No user found
        header("location: login.php?err=1");
        exit();
    }
} else {
    // If form wasn't properly submitted
    header("location: index.php");
    exit();
}

// Redirect if session is null (no user is logged in)
if (!isset($_SESSION["userID"])) {
    header("location: login.php");
    exit();
}


?>
