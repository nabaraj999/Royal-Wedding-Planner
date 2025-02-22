<?php
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access Denied: You must be an admin.");
}

// Include DB connection
include('../../connection/config.php'); 

// Initialize message variable
$message = "";

// Handle Approve or Reject button click
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']); // Ensure ID is an integer

    if ($action === 'approve' || $action === 'reject') {
        // Check if ID exists in the database
        $check = $conn->prepare("SELECT id FROM bookings WHERE id = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $resultCheck = $check->get_result();

        if ($resultCheck->num_rows === 0) {
            $message = "Error: Booking ID not found.";
        } else {
            // Update booking status
            $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("si", $action, $id);
            
            if ($stmt->execute()) {
                $message = "Booking has been " . ($action === 'approve' ? "approved" : "rejected") . ".";
                header("Refresh:2; url=admin_bookings.php"); // Redirect after 2 seconds
                exit();
            } else {
                $message = "Error updating booking status: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Pagination
$limit = 20; // Limit records per page
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Query to fetch bookings
$query = "SELECT * FROM bookings ORDER BY id DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - View Bookings</title>
    <link rel="stylesheet" href="../css/admin_booking.css">
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="admin-profile">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Profile" class="profile-icon">
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="admin_contact.php">Contact Us</a></li>
                <li><a href="admin_booking.php">View Bookings</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
            </ul>
            <button class="logout" onclick="location.href='logout.php'">Logout</button>
        </div>

        <div class="main-content">
            <h1>Bookings</h1>

            <!-- Display messages -->
            <?php if (!empty($message)): ?>
                <p style="color: red;"><?php echo $message; ?></p>
            <?php endif; ?>

            <table border="1">
                <tr>
                    <th>Bride Name</th>
                    <th>Groom Name</th>
                    <th>Wedding Date</th>
                    <th>Total Cost</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['bride_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['groom_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['marriage_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_cost']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            
                            <td>
                                <a href="view_booking_details.php?id=<?php echo $row['id']; ?>" class="details-btn">View Details</a>
                                <?php if ($row['status'] == 'pending'): ?>
                                    <a href="admin_booking.php?action=approve&id=<?php echo $row['id']; ?>" class="approve-btn">Approve</a>
                                    <a href="admin_booking.php?action=reject&id=<?php echo $row['id']; ?>" class="reject-btn">Reject</a>
                                <?php else: ?>
                                    <span>Action completed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">No bookings found.</td></tr>
                <?php endif; ?>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo ($page - 1); ?>">Previous</a>
                <?php endif; ?>
                <a href="?page=<?php echo ($page + 1); ?>">Next</a>
            </div>
        </div>
    </div>

    <?php
    // Close the database connection
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
