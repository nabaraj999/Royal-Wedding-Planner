<?php
include'./header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link rel="stylesheet" href="./css/contact.css">
    <!-- Contact Section -->
    <section class="contact">
        <h2>Contact Our Team</h2>
        <p>Have questions? We'd love to hear from you!</p>

        <div class="contact-container">
            <?php if ($isLoggedIn): ?>
            <!-- Contact Form - only shown to logged-in users -->
            <div class="contact-form">
                <h3>Send Us a Message</h3>

                <form action="save_contact.php" method="POST">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
            <?php else: ?>
            <!-- Message for non-logged in users -->
            <div class="login-message">
                <h3>Want to contact us directly?</h3>
                <p>Please <a href="./Login/login.php">login</a> to send us a message through our contact form.</p>
                <button onclick="location.href='./Login/login.php'" class="login">Login to Contact Us</button>
            </div>
            <?php endif; ?>

            <!-- Contact Info - shown to all users -->
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
            <a href="index.php">Home</a>
            <a href="About_us.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if ($isLoggedIn): ?>
            <a href="booking.php">Book</a>
            <?php endif; ?>
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