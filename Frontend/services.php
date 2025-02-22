<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    // Redirect to login page if not logged in
    header("Location: ./Login/login.php");
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
    <title>Royal Wedding Planner</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/services.css">

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
                 
                    <span class="username"><?php echo $_SESSION['username']; ?></span>
                    <button class="logout" onclick="location.href='logout.php'">Logout</button>
                <?php else: ?>
                  
                    <span class="username">Guest</span>
                    <button class="logout" onclick="location.href='./Login/login.php'">Login</button>
                <?php endif; ?>

                <a href="profile.php">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Profile" class="profile-icon">
                </a>
            </div>
        </nav>
    </header>
        </nav>
    </header>



    <section class="services">
        <h2>Our Services</h2>
        <div class="service-container">
            <div class="service-card">
                <img src="./image/theme.jpg" alt="Theme">
                <h3>Theme</h3>
            </div>
            <div class="service-card">
                <img src="./image/venue.jpg" alt="Venue">
                <h3>Venue</h3>
            </div>
            <div class="service-card">
                <img src="./image/Music_Entertainment.jpg" alt="Music/Entertainment">
                <h3>Music & Entertainment</h3>
            </div>
            <div class="service-card">
                <img src="./image/Catering.jpg" alt="Catering">
                <h3>Catering</h3>
            </div>
            <div class="service-card">
                <img src="./image/Decoration.jpg" alt="Decoration">
                <h3>Decoration</h3>
            </div>
            <div class="service-card">
                <img src="./image/wedding-card.jpg" alt="Wedding Card">
                <h3>Wedding Card</h3>
            </div>
        </div>
    </section>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<footer>
    <div class="footer-container">
        <div class="footer-left">
            <p>&copy; 2025 Royal Wedding Planner</p>
            <p>123 Royal Street, New York, NY 10001</p>
        </div>

        <div class="footer-center">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="#book">Book</a>
        </div>

        <div class="footer-right">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
    </div>
</footer>
