<?php
include'./header.php';
?>
    <main>
    <section id="home">
    <div class="home-image">
        <img src="./image/1315478.jpg" alt="Wedding Image">
        <div class="overlay-text">
            <h1>Welcome to Royal Wedding Planner</h1>
            <p>Plan your dream wedding with elegance and perfection.</p>
            <?php if ($isLoggedIn): ?>
                <button class="cta-button" onclick="location.href='booking.php'">Book Now</button>
            <?php else: ?>
                <button class="cta-button" onclick="location.href='services.php'">Get Started</button>
            <?php endif; ?>
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
            <?php if ($isLoggedIn): ?>
            <a href="#book">Book</a>
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

</main>
    <script src="./js/index.js">    
    </script>
</body>
</html>