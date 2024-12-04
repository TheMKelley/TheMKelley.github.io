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

// Check if the user is an admin
$userID = $_SESSION["userID"];
$query = "SELECT isAdmin FROM user WHERE id = :userID";
$stmt = $connection->prepare($query);
$stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !$user['isAdmin']) {
    // If user is not found or not an admin, redirect
    header("location: users.php?error=Unauthorized");
    exit();
}

// Check if the user ID to delete is provided in the URL
if (isset($_GET['id'])) {
    $idToDelete = $_GET['id'];

    // Proceed to delete the user
    $deleteQuery = "DELETE FROM user WHERE id = :id";
    $deleteStmt = $connection->prepare($deleteQuery);
    $deleteStmt->bindParam(":id", $idToDelete, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        header("location: users.php?success=UserDeleted");
    } else {
        header("location: users.php?error=DeleteFailed");
    }
} else {
    // If no ID is provided, redirect back with an error
    header("location: users.php?error=NoUserID");
    exit();
}
?>
