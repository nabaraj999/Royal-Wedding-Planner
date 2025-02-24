<?php
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Include DB connection
include('../../connection/config.php');

// Get booking ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid booking ID");
}
$id = intval($_GET['id']);

// Fetch booking details
$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    die("Booking not found");
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Booking Details</title>
    <link rel="stylesheet" href="../css/view_booking_details.css">
</head>
<body>
    <div class="wedding-card">
        <h2>Wedding Invitation</h2>
        <p><strong>Bride:</strong> <?php echo htmlspecialchars($booking['bride_name']); ?></p>
        <p><strong>Groom:</strong> <?php echo htmlspecialchars($booking['groom_name']); ?></p>
        <p><strong>Marriage Date:</strong> <?php echo htmlspecialchars($booking['marriage_date']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($booking['phone_number']); ?></p>
        <p><strong>Total Cost:</strong> <?php echo htmlspecialchars($booking['total_cost']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($booking['username']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($booking['status']); ?></p>

        <!-- Bride and Groom Photos -->
        <h3>Wedding Photos</h3>
        <p><strong>Bride Photo:</strong> <br>
            <img src="../../uploads/<?php echo htmlspecialchars($booking['bride_photo']); ?>" alt="Bride Photo" width="150">
        </p>

        <p><strong>Groom Photo:</strong> <br>
            <img src="../../uploads/<?php echo htmlspecialchars($booking['groom_photo']); ?>" alt="Groom Photo" width="150">
        </p>

        <h3>Packages</h3>
        <p><strong>Catering:</strong> <?php echo htmlspecialchars($booking['catering_package']); ?></p>
        <p><strong>Decoration:</strong> <?php echo htmlspecialchars($booking['decoration_package']); ?></p>
        <p><strong>Card Design:</strong> <?php echo htmlspecialchars($booking['card_package']); ?></p>
        <p><strong>Venue:</strong> <?php echo htmlspecialchars($booking['venue_package']); ?></p>

        <a href="admin_booking.php" class="back-btn">Back to Bookings</a>
    </div>
</body>
</html>
