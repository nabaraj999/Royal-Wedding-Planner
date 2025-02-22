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



    <main>
    <section id="home">
    <div class="home-image">
        <img src="./image/1315478.jpg" alt="Wedding Image">
        <div class="overlay-text">
            <h1>Welcome to Royal Wedding Planner</h1>
            <p>Plan your dream wedding with elegance and perfection.</p>
            <button class="cta-button">Get Started</button>
        </div>
    </div>
</section>


<section id="features">
    <div class="features-container">
        <div class="feature-card">
            <img src="./image/1.jpg" alt="Feature Image" class="feature-img">
            <div class="feature-info">
                <h3>Elegant Weddings</h3>
                <p>We create luxurious and beautiful weddings tailored to your dream.</p>
            </div>
        </div>
        <div class="feature-card">
            <img src="./image/2.jpg" alt="Feature Image" class="feature-img">
            <div class="feature-info">
                <h3>Expert Planning</h3>
                <p>Our expert team handles every detail with precision and care.</p>
            </div>
        </div>
        <div class="feature-card">
            <img src="./image/3.jpg" alt="Feature Image" class="feature-img">
            <div class="feature-info">
                <h3>Personalized Themes</h3>
                <p>Choose from a wide range of themes that reflect your personal style.</p>
            </div>
        </div>
        <div class="feature-card">
            <img src="./image/4.jpg" alt="Feature Image" class="feature-img">
            <div class="feature-info">
                <h3>Stunning Venues</h3>
                <p>We provide access to breathtaking venues for your special day.</p>
            </div>
        </div>
       
    </div>
</section>


<!-- Load Font Awesome for icons -->
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



</main>
    <script src="./js/index.js">    
    </script>
</body>
</html>
