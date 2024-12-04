<?php 
include("header.php");

// Check if the user is logged in
$isLoggedIn = isset($_SESSION["userID"]);
?>
<title>Home</title>

<!-- Begin Code -->
<?php if ($isLoggedIn): ?>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['FName']); ?></h1>
    <main>
    <?php 
    // Show a one-time login notification
    if (isset($_SESSION['loggedInMessage'])) {
        echo "<div class='message-box success'>".htmlspecialchars($_SESSION['loggedInMessage'])."</div>";
        // Clear the message after displaying it
        unset($_SESSION['loggedInMessage']);
    }
    ?>
    </main>
<?php else: ?>
    <h1>Welcome to Michael's Site!</h1>
    <h1>Please sign in or register.</h1>
    <main>
    <?php 
    // Show logout message if set
    if (isset($_SESSION['logoutMessage'])) {
        echo "<div class='message-box error'>".htmlspecialchars($_SESSION['logoutMessage'])."</div>";
        // Clear the message after displaying it
        unset($_SESSION['logoutMessage']);
    }
    ?>
    </main>
<?php endif; ?>
<main>
<p>You are visiting Michael Kelley's CRUD Site.</p>
</main>

<?php include("footer.php") ?>
