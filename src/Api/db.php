<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP, WAMP, MAMP is empty
$database = "credential"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
mysqli_set_charset($conn, 'utf8');

?>

