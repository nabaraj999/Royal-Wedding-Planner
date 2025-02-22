<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Dummy logic for role and username (replace with real session data)
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$email = $_SESSION['email']; 

// Assume the profile image is fetched from the database or is NULL
$profileImage = null; // Simulate that the profile photo is unavailable

// Use default profile image if no profile photo is available
if (empty($profileImage)) {
    $profileImage = './image/defult.png'; // Path to the default image
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<header>
        <nav>
            <div class="nav-left">
               <img src="./image/logo.png" class="logo" alt="Royal Wedding Planner Logo">
            </div>
            <div class="nav-center">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="booking.php">Book</a></li>
                    <li><a href="About_us.php">About Us</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <?php if (isset($_SESSION['username']) && $_SESSION['username'] !== ""): ?>
                    <!-- If user is logged in, display username and Logout button -->
                    <span class="username"><?php echo $_SESSION['username']; ?></span>
                    <button class="logout" onclick="location.href='logout.php'">Logout</button>
                <?php else: ?>
                    <!-- If user is not logged in, display 'Guest' username and Login button -->
                    <span class="username">Guest</span>
                    <button class="logout" onclick="location.href='./Login/login.php'">Login</button>
                <?php endif; ?>

                <!-- Profile Icon (wrap it with an anchor tag for redirection) -->
                <a href="profile.php">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Profile" class="profile-icon">
                </a>
            </div>
        </nav>
    </header>


    <!-- Profile Section -->
    <div class="user-container">
        <div class="profile-img-container">
            <img src="<?= htmlspecialchars($profileImage) ?>" alt="Profile Image" class="profile-img">
        </div>
        
        <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
        <p><strong>Role:</strong> <?= htmlspecialchars($role) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>

        <a href="change_password.php" class="btn">Change Password</a>
        <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>
</body>
</html>
