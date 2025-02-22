<?php
// Start the session
session_start();

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    // Redirect to login page if the user is not logged in or is not an admin
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Royal Wedding Planner</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="admin-profile">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Profile" class="profile-icon">
                <p><?php echo $_SESSION['username']; ?></p>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="admin_contact.php">Contact Us</a></li>
                <li><a href="admin_booking.php">View Bookings</a></li>
                <li><a href="manage_users.php">Manage_user</a></li>
            </ul>
            <button class="logout" onclick="location.href='logout.php'">Logout</button>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Welcome to the Admin Panel</h1>
            <p>Manage your wedding planning services here.</p>

            <!-- Content will change depending on the selected page -->
        </div>
    </div>
</body>
</html>
