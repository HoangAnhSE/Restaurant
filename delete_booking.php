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

// Delete booking based on ID
$sql = "DELETE FROM `booking` WHERE `id`='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Booking deleted successfully";
} else {
    echo "Error deleting booking: " . $conn->error;
}

$conn->close();
?>
