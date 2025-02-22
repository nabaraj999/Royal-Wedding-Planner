<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "r_wedding_planner";

$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>