<?php include("header.php") ?>
<title>Register</title>

<!-- Begin Code -->
<h1>Register</h1>
<main>
<form action="registerProcessing.php" method="post" name="registerForm">
    <!-- Input first name - required -->
    <label for="FNameInput">First Name: </label>
    <input type="text" id="FNameInput" name="FNameInput" required> <br>
    
    <!-- Input last name - required -->
    <label for="LNameInput">Last Name: </label>
    <input type="text" id="LNameInput" name="LNameInput" required> <br>
    
    <!-- Input email - required, type email -->
    <label for="emailInput">Email: </label>
    <input type="email" id="emailInput" name="emailInput" required> <br>
    
    <!-- Input password - required, hashed in registerProcessing using Bcrypt -->
    <label for="passwordInput">Password: </label>
    <input type="password" id="passwordInput" name="passwordInput" required 
    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&]{8,}$" 
    ?>
    <p>Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.</p><br>

    <!-- Submit form to registerProcessing -->
    <input class ="hdrButton" type="submit" value="Register" name="submit">

    <!-- Add regex for password requirements -->
</form>
</main>
<?php include("footer.php") ?>
