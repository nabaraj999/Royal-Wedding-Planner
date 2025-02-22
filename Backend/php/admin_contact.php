<?php
// Start the session

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  
}
?>

<?php
// Admin Contact Page
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch contact messages from the database
include('../../connection/config.php');
$query = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Contact Us</title>
    <link rel="stylesheet" href="../css/admin_contact.css">
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
  

        <div class="main-content">
            <h1>Contact Us Queries</h1>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
