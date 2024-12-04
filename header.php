<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
?>
<body>
<!-- Header tag for CSS styling -->
<header>
    <div class="header-label">VMI Cyber Defense Lab</div>
    <?php if (isset($_SESSION["userID"])): ?>
        <!-- Only show these buttons when logged in -->
        <a class="hdrButton" href="index.php">Home</a>
        <a class="hdrButton" href="users.php">Edit Users</a>
        <a class="hdrButton" href="logout.php">Log Out</a>
    <?php else: ?>
        <!-- Available for Guests -->
        <a class="hdrButton" href="register.php">Register</a>
        <a class="hdrButton" href="login.php">Login</a>
        <a class="hdrButton" href="index.php">Home</a>
    <?php endif; ?>
</header>
