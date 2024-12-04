<?php
include("connection.php");

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("location: login.php");
    exit();
}

$userID = $_SESSION["userID"];
$isAdmin = false;

// Check if the logged-in user is an admin and get their password hash
$query = "SELECT isAdmin, password FROM user WHERE id = :userID";
$stmt = $connection->prepare($query);
$stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
$stmt->execute();
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

if ($currentUser) {
    $isAdmin = $currentUser["isAdmin"];
    $adminPasswordHash = $currentUser["password"]; // Store admin's password hash
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['FName'];
    $lastName = $_POST['LName'];
    $email = $_POST['Email'];

    // Only allow non-admins to edit their own information
    if (!$isAdmin && $id != $userID) {
        header("location: users.php?error=Unauthorized");
        exit();
    }

    // Prepare the update query
    $updateQuery = "UPDATE user SET FName = :FName, LName = :LName, Email = :Email";
    $updateParams = [
        ':FName' => $firstName,
        ':LName' => $lastName,
        ':Email' => $email,
        ':id' => $id,
    ];

    // Handle password update
    if (!empty($_POST['newPassword'])) {
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword !== $confirmPassword) {
            header("location: users.php?error=PasswordMismatch");
            exit();
        }

        // Check if admin is updating another user's password or user updating their own
        if ($isAdmin && $id != $userID) {
            // Admin must confirm their own password
            $adminPassword = $_POST['adminPassword'];
            if (!password_verify($adminPassword, $adminPasswordHash)) {
                header("location: users.php?error=AdminPasswordIncorrect");
                exit();
            }
        } else {
            // Regular user must confirm their own password
            $currentPassword = $_POST['currentPassword'];
            if (!password_verify($currentPassword, $currentUser['password'])) {
                header("location: users.php?error=PasswordIncorrect");
                exit();
            }
        }

        // Update with the new password hash
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery .= ", password = :password";
        $updateParams[':password'] = $hashedPassword;
    }

    // Execute the update query
    $updateQuery .= " WHERE id = :id";
    $updateStmt = $connection->prepare($updateQuery);
    $updateStmt->execute($updateParams);

    $_SESSION['successMessage'] = "Information successfully updated.";
    header("location: users.php");
    exit();
} else {
    // If form wasn't properly submitted
    header("location: users.php");
    exit();
}
