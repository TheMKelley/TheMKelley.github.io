<?php
include("connection.php");
include("header.php");

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    header("location: login.php");
    exit();
}

// Fetch user details
$query = "SELECT id, FName, LName, Email, isAdmin FROM user";
$stmt = $connection->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the current user is an admin
$isAdmin = false;
$currentUser = null;

foreach ($users as $user) {
    if ($user['id'] == $_SESSION["userID"]) {
        $isAdmin = $user['isAdmin'];
        $currentUser = $user;
        break;
    }
}

// Handle messages
$successMessage = '';
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']); // Clear the message after showing
}

$errorMessage = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'PasswordIncorrect') {
        $errorMessage = "Incorrect password entered.";
    } elseif ($_GET['error'] == 'PasswordMismatch') {
        $errorMessage = "New passwords do not match.";
    }
}

if ($isAdmin) {
    // Admin can see all users
    $usersToDisplay = $users;
} else {
    // Regular user can only see their own info
    $usersToDisplay = array_filter($users, function($user) {
        return $user['id'] == $_SESSION["userID"];
    });
}
?>

<?php if ($successMessage): ?>
    <p style='color:green;'><?php echo htmlspecialchars($successMessage); ?></p>
<?php endif; ?>

<?php if ($errorMessage): ?>
    <p style='color:red;'><?php echo htmlspecialchars($errorMessage); ?></p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usersToDisplay as $user): ?>
            <tr>
                <form action="updateUser.php" method="post" class="user-form">
                    <td><input type="text" name="FName" value="<?php echo htmlspecialchars($user['FName']); ?>" required></td>
                    <td><input type="text" name="LName" value="<?php echo htmlspecialchars($user['LName']); ?>" required></td>
                    <td><input type="email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>" required></td>
                    <td>
                        <?php if ($isAdmin && $user['id'] != $currentUser['id']): ?>
                            <!-- Admin editing another user's info: prompt for admin password -->
                            <input type="password" name="adminPassword" placeholder="Admin Password (required)" required>
                        <?php else: ?>
                            <!-- Regular user or admin editing their own info: prompt for current password -->
                            <input type="password" name="currentPassword" placeholder="Current Password" required>
                        <?php endif; ?>
                        <input type="checkbox" id="changePasswordCheckbox-<?php echo $user['id']; ?>" onchange="toggleNewPasswordFields(<?php echo $user['id']; ?>)">
                        <label for="changePasswordCheckbox-<?php echo $user['id']; ?>">Change Password</label>
                        <div id="newPasswordFields-<?php echo $user['id']; ?>" style="display:none;">
                            <input type="password" name="newPassword" placeholder="New Password">
                            <input type="password" name="confirmPassword" placeholder="Confirm Password">
                        </div>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit">Save</button>
                        <?php if ($isAdmin): ?>
                            <button type="button" class="delete-button" data-id="<?php echo $user['id']; ?>">Delete</button>
                        <?php endif; ?>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = `deleteUser.php?id=${userId}`;
            }
        });
    });

    function toggleNewPasswordFields(userId) {
        const newPasswordFields = document.getElementById(`newPasswordFields-${userId}`);
        if (newPasswordFields.style.display === "none") {
            newPasswordFields.style.display = "block";
        } else {
            newPasswordFields.style.display = "none";
        }
    }
</script>

<?php include("footer.php"); ?>
