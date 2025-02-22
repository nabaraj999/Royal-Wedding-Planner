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
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="stylesheet" href="./css/index.css">
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


    <!-- Contact Section -->
    <section class="contact">
        <h2>Contact Our Team</h2>
        <p>Have questions? We'd love to hear from you!</p>

        <div class="contact-container">
            <!-- Contact Form -->
            <div class="contact-form">
                <h3>Send Us a Message</h3>

                <form action="save_contact.php" method="POST">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>

            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <h3>Contact Details</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Royal Street, New York, NY 10001</p>
                <p><i class="fas fa-envelope"></i> contact@royalweddingplanner.com</p>
                <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
        <h2>Meet Our Team</h2>
        <div class="team-container">
            <div class="team-card">
                <img src="./image/dristi.jpg" alt="Dristi">
                <h3>Dristi Bajracharya</h3>
                <p>Event Planner</p>
            </div>
            <div class="team-card">
                <img src="./image/nir.jpg" alt="Jane Smith">
                <h3>Nirbhaya Dangol</h3>
                <p>Venue Manager</p>
            </div>
            <div class="team-card">
                <img src="./image/music.jpg" alt="Michael Brown">
                <h3>V-Ten</h3>
                <p>Music & Entertainment</p>
            </div>
        </div>
    </section>



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


</body>
</html>
