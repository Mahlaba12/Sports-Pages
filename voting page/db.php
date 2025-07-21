<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Adjust if your MySQL has a password
$dbname = 'sport_voting';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
