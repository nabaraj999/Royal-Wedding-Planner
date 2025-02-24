<?php 
session_start(); 


$isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']); 

$profileImage = './image/defult.png'; // Default image path

if ($isLoggedIn) {
 
    $userProfileImage = null; // Simulate database fetch
    
    if (!empty($userProfileImage)) {
        $profileImage = $userProfileImage;
    }
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
                    <?php if ($isLoggedIn): ?>
                    <li><a href="booking.php">Book</a></li>
                    <?php endif; ?>
                    <li><a href="About_us.php">About Us</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <?php if ($isLoggedIn): ?>
                    <!-- Logged in user display -->
                    <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <button class="logout" onclick="location.href='logout.php'">Logout</button>
                    <a href="profile.php">
                        <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile" class="profile-icon">
                    </a>
                <?php else: ?>
                    <!-- Guest user display -->
                    <span class="username">Guest</span>
                    <button class="logout" onclick="location.href='./Login/login.php'">Login</button>
                    <a href="./Login/login.php">
                        <img src="./image/defult.png" alt="Guest Profile" class="profile-icon">
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>