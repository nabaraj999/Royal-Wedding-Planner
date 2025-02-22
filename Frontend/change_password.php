<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "../connection/config.php";

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get new password details from the form
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password strength (Minimum 8 chars, at least 1 number, and 1 special character)
    if (strlen($new_password) < 8 || !preg_match("/[0-9]/", $new_password) || !preg_match("/[\W]/", $new_password)) {
        $error = "Password must be at least 8 characters long, include a number and a special character.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashed_password, $_SESSION['username']);

        if ($stmt->execute()) {
            $success = "Password successfully changed!";
        } else {
            $error = "Failed to update password.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="./css/change_password.css">
</head>
<body>
    <div class="password-container">
        <h1>Change Password</h1>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
