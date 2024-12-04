<?php
include("connection.php");

if (isset($_POST["submit"])) {
    $firstName = $_POST["FNameInput"];
    $lastName = $_POST["LNameInput"];
    $email = $_POST["emailInput"];
    $password = $_POST["passwordInput"];
    //TO DO: No duplicate emails (SQL Query: return email, if anything comes back, its been registered)

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL query to insert the new user into the database
    $query = "INSERT INTO user (FName, LName, Email, Password) VALUES (:firstName, :lastName, :email, :password)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam("firstName", $firstName, PDO::PARAM_STR);
    $stmt->bindParam("lastName", $lastName, PDO::PARAM_STR);
    $stmt->bindParam("email", $email, PDO::PARAM_STR);
    $stmt->bindParam("password", $hashedPassword, PDO::PARAM_STR);

    // Execute the query and redirect to the login page if successful
    if ($stmt->execute()) {
        header("location: login.php");
        exit();
} else {
    // Redirect to the index page if form was not properly submitted
    header("location: index.php");
    exit();
    }
}
?>
