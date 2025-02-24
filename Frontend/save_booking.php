<?php
include '../connection/config.php';
session_start(); // Make sure to start the session

// File Upload Handling function
function uploadImage($file, $folder) {
    $target_dir = "../uploads/" . $folder . "/";
    $file_name = basename($file["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;
    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    move_uploaded_file($file["tmp_name"], $target_file);
    return $target_file;
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username from session
    $username = $_SESSION["username"];
    
    $bride_name = $_POST["bride_name"];
    $groom_name = $_POST["groom_name"];
    $bride_father = $_POST["bride_father"];
    $bride_mother = $_POST["bride_mother"];
    $groom_father = $_POST["groom_father"];
    $groom_mother = $_POST["groom_mother"];
    $marriage_date = $_POST["marriage_date"];
    $phone_number = $_POST["phone_number"];
    $catering_package = $_POST["catering"];
    $decoration_package = $_POST["decoration"];
    $card_package = $_POST["card"];
    $venue_package = $_POST["venue"];
    $total_cost = $_POST["total_cost"];
    
    $bride_photo = uploadImage($_FILES["bride_photo"], "brides");
    $groom_photo = uploadImage($_FILES["groom_photo"], "grooms");
    
    // Updated SQL query to include username
    $stmt = $conn->prepare("INSERT INTO bookings (username, bride_name, groom_name, bride_father, bride_mother, groom_father, groom_mother, phone_number, bride_photo, groom_photo, marriage_date, catering_package, decoration_package, card_package, venue_package, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Added username to bind_param
    $stmt->bind_param("ssssssssssssssss", $username, $bride_name, $groom_name, $bride_father, $bride_mother, $groom_father, $groom_mother, $phone_number, $bride_photo, $groom_photo, $marriage_date, $catering_package, $decoration_package, $card_package, $venue_package, $total_cost);
    
    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='booking.php';</script>";
    } else {
        echo "<script>alert('Error booking. Try again!');</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>