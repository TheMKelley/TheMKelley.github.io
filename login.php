<?php include("header.php") ?>
<title>Login</title>
<!-- Meta Data -->


<!-- Begin Code -->
<h1>Login</h1>
<main>
<form action="loginProcessing.php" method="post" name="loginForm">
    <!-- Input email -->
    <label for="emailInput">Email: </label>
    <input type="text" id="emailInput" name="emailInput" required> <br>
    <!-- Input password -->
    <label for="passwordInput">Password: </label>
    <input type="password" id="passwordInput" name="passwordInput" required> <br>
    <input class="hdrButton" type="submit" value="Submit" name="submit">
</form>
<?php
    // Create an error if email or password is incorrect.
    if (isset($_GET["err"])) {
        echo "<p style='color:red;'>" .htmlspecialchars("Incorrect email or password. Please try again.") . "</p>";
    }

?>
</main>

<?php include("footer.php") ?>
