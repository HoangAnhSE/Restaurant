<?php
session_start();

// Check if the user is logged in as an admin, if not, redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'restaurant');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter exists in URL
if (!isset($_GET['id'])) {
    // Handle if ID is not provided
    header("Location: adminhome.php");
    exit();
}

// Get the ID from URL
$id = $_GET['id'];

// Fetch booking details based on ID
$sql = "SELECT * FROM `booking` WHERE `id`='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch booking data
    $row = $result->fetch_assoc();
    // Display form to edit booking details
    // You can create a form here to update the booking details
    // Populate the form fields with $row['name'], $row['phone'], etc.
} else {
    // Handle if booking ID not found
    echo "Booking not found";
}

$conn->close();
?>
