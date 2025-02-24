<?php
// Start the session
session_start();

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Process delete action if requested
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    include('../../connection/config.php');
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM contact_messages WHERE id = $id";
    
    if (mysqli_query($conn, $delete_query)) {
        // Redirect to prevent form resubmission on refresh
        header("Location: admin_contact.php?deleted=true");
        exit();
    } else {
        $error = "Error deleting record: " . mysqli_error($conn);
    }
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
    <style>
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
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
        
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true'): ?>
            <div class="success-message">Message deleted successfully!</div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="admin_contact.php?delete=<?php echo $row['id']; ?>" 
                           class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this message?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>