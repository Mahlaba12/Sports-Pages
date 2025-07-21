<?php
// Database configuration
$host = 'localhost';         // Replace with your database host if different
$dbname = 'sport_voting';    // Your database name
$username = 'root';          // Your MySQL username
$password = '';              // Your MySQL password

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
