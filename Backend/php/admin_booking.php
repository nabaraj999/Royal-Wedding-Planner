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
$messageClass = "";

// Handle Approve or Reject button click
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']); // Ensure ID is an integer

    if ($action === 'approve' || $action === 'reject') {
        // Check if ID exists in the database
        $check = $conn->prepare("SELECT id, status FROM bookings WHERE id = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $resultCheck = $check->get_result();

        if ($resultCheck->num_rows === 0) {
            $message = "Error: Booking ID not found.";
            $messageClass = "error";
        } else {
            $booking = $resultCheck->fetch_assoc();
            
            // Only process if status is pending
            if ($booking['status'] !== 'pending') {
                $message = "This booking has already been " . $booking['status'] . ".";
                $messageClass = "warning";
            } else {
                // Set the correct status value based on enum field options
                $newStatus = ($action === 'approve') ? 'approved' : 'rejected';
                
                // Update booking status
                $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }

                $stmt->bind_param("si", $newStatus, $id);
                
                if ($stmt->execute()) {
                    $message = "Booking has been " . $newStatus . " successfully.";
                    $messageClass = "success";
                } else {
                    $message = "Error updating booking status: " . $stmt->error;
                    $messageClass = "error";
                }
                $stmt->close();
            }
        }
    }
}

// Pagination
$limit = 20; // Limit records per page
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Count total records for pagination
$countQuery = "SELECT COUNT(*) as total FROM bookings";
$countResult = $conn->query($countQuery);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

// Query to fetch bookings
$query = "SELECT * FROM bookings ORDER BY created_at DESC LIMIT ? OFFSET ?";
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
    <style>
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            text-decoration: none;
        }
        .pagination .current {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
        .pagination a:hover {
            background-color: #f1f1f1;
        }
        .status-pending {
            color: #856404;
            background-color: #fff3cd;
            padding: 3px 6px;
            border-radius: 3px;
        }
        .status-approved {
            color: #155724;
            background-color: #d4edda;
            padding: 3px 6px;
            border-radius: 3px;
        }
        .status-rejected {
            color: #721c24;
            background-color: #f8d7da;
            padding: 3px 6px;
            border-radius: 3px;
        }
    </style>
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
                <li><a href="admin_booking.php" class="active">View Bookings</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
            </ul>
            <button class="logout" onclick="location.href='logout.php'">Logout</button>
        </div>

        <div class="main-content">
            <h1>Bookings</h1>

            <!-- Display messages -->
            <?php if (!empty($message)): ?>
                <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
            <?php endif; ?>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Bride Name</th>
                    <th>Groom Name</th>
                    <th>Wedding Date</th>
                    <th>Total Cost</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['bride_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['groom_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['marriage_date']); ?></td>
                            <td><?php echo number_format($row['total_cost'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td>
                                <span class="status-<?php echo $row['status']; ?>">
                                    <?php echo ucfirst(htmlspecialchars($row['status'])); ?>
                                </span>
                            </td>
                            
                            <td>
                                <a href="view_booking_details.php?id=<?php echo $row['id']; ?>" class="details-btn">View Details</a>
                                <?php if ($row['status'] === 'pending'): ?>
                                    <a href="admin_booking.php?action=approve&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>" class="approve-btn" onclick="return confirm('Are you sure you want to approve this booking?');">Approve</a>
                                    <a href="admin_booking.php?action=reject&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>" class="reject-btn" onclick="return confirm('Are you sure you want to reject this booking?');">Reject</a>
                                <?php else: ?>
                                    <span>No actions available</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="8">No bookings found.</td></tr>
                <?php endif; ?>
            </table>

            <!-- Improved Pagination Controls -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=1">First</a>
                    <a href="?page=<?php echo ($page - 1); ?>">Previous</a>
                <?php else: ?>
                    <span>First</span>
                    <span>Previous</span>
                <?php endif; ?>
                
                <?php
                // Display page numbers
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    if ($i == $page) {
                        echo "<span class='current'>$i</span>";
                    } else {
                        echo "<a href='?page=$i'>$i</a>";
                    }
                }
                ?>
                
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo ($page + 1); ?>">Next</a>
                    <a href="?page=<?php echo $totalPages; ?>">Last</a>
                <?php else: ?>
                    <span>Next</span>
                    <span>Last</span>
                <?php endif; ?>
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