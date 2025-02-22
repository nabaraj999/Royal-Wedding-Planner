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
    <title>About Us - Royal Wedding Planner</title>
    <link rel="stylesheet" href="./css/about_us.css">
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


    <div class="about-container">
        <h1>About Us</h1>
        <div class="about-content">
            <p>Welcome to Royal Wedding Planner, where we specialize in making your dream wedding come true! Our team of experts brings you a range of services that ensure your special day is nothing short of magical. We pride ourselves on our attention to detail, quality service, and personalized wedding planning.</p>

            <p>Whether you’re planning a traditional ceremony or a modern celebration, we have everything you need—from top-notch catering to beautiful venues and exquisite decorations.</p>

            <p>At Royal Wedding Planner, we understand that every couple is unique, and we are committed to turning your vision into reality. Let us help you create unforgettable memories!</p>
        </div>

        <div class="section-title">Our Mission</div>
        <p>Our mission is to provide personalized, high-quality wedding planning services that make every couple’s wedding day stress-free and unforgettable. We believe in creating an atmosphere where love, joy, and celebration come together seamlessly.</p>

        <div class="section-title">Our Vision</div>
        <p>To be the leading wedding planning service known for exceptional experiences, unmatched attention to detail, and the ability to create beautiful moments that will last a lifetime.</p>

        <div class="section-title">Our Values</div>
        <p>We stand for passion, creativity, and professionalism in everything we do. Our team is dedicated to ensuring that every wedding we plan reflects the individual style and preferences of our clients.</p>

        <div class="section-title">Meet Our Team</div>
        <div class="about-team">
            <div class="team-member">
                <img src="./image/dristi.jpg" alt="Team Member 1">
                <h3>Dristi Bajracharya</h3>
                <p>Wedding Planner</p>
            </div>
            <div class="team-member">
                <img src="./image/nir.jpg" alt="Team Member 2">
                <h3>Nirbhaya Dangol</h3>
                <p>Catering Expert</p>
            </div>
            <div class="team-member">
                <img src="./image/music.jpg" alt="Team Member 3">
                <h3>v-Ten</h3>
                <p>Decor Specialist</p>
            </div>
        </div>
    </div>


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

</body>
</html>
