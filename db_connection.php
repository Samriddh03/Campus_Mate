<?php
$servername = "localhost";
$username = "root"; // Change if using a different username
$password = ""; // Change if you have a password set
$database = "bit_durg";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
