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
    <title>Wedding Booking</title>
    <link rel="stylesheet" href="./css/booking.css">
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

    <div class="booking-container">
        <div class="booking-form">
            <h2 class="a">Wedding Booking Form</h2>
            <form action="./save_booking.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                <input type="text" name="bride_name" placeholder="Bride Name" required>
                <input type="text" name="groom_name" placeholder="Groom Name" required>
                <input type="text" name="bride_father" placeholder="Bride Father Name" required>
                <input type="text" name="bride_mother" placeholder="Bride Mother Name" required>
                <input type="text" name="groom_father" placeholder="Groom Father Name" required>
                <input type="text" name="groom_mother" placeholder="Groom Mother Name" required>
                <input type="tel" name="phone_number" placeholder="Phone Number" required>
                
                <label>Bride Photo:</label>
                <input type="file" name="bride_photo" accept="image/*" required>
                
                <label>Groom Photo:</label>
                <input type="file" name="groom_photo" accept="image/*" required>

                <label>Select Marriage Date:</label>
                <input type="date" name="marriage_date" required>

                <label>Catering Package:</label>
                <select name="catering" id="catering" onchange="calculateTotal()">
                    <option value="200000">Silver (₹2,00,000)</option>
                    <option value="500000">Gold (₹5,00,000)</option>
                    <option value="1000000">Platinum (₹10,00,000)</option>
                </select>

                <label>Decoration Package:</label>
                <select name="decoration" id="decoration" onchange="calculateTotal()">
                    <option value="200000">Silver (₹2,00,000)</option>
                    <option value="500000">Gold (₹5,00,000)</option>
                    <option value="1000000">Platinum (₹10,00,000)</option>
                </select>

                <label>Card Package:</label>
                <select name="card" id="card" onchange="calculateTotal()">
                    <option value="10000">Silver (₹10,000)</option>
                    <option value="20000">Gold (₹20,000)</option>
                    <option value="50000">Platinum (₹50,000)</option>
                </select>

                <label>Venue Package:</label>
                <select name="venue" id="venue" onchange="calculateTotal()">
                    <option value="200000">Silver (₹2,00,000)</option>
                    <option value="500000">Gold (₹5,00,000)</option>
                    <option value="1000000">Platinum (₹10,00,000)</option>
                </select>

                <h3 id="totalCost">Total Cost: ₹2,00,000</h3>
                <input type="hidden" name="total_cost" id="total">

                <button type="submit">Submit Booking</button>
            </form>
        </div>
        
        <div class="view-booking-btn">
            <a href="view_booking.php">View Your Bookings</a>
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


    <script src="./js/booking.js"></script>
</body>
</html>