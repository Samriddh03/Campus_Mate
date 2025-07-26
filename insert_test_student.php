<?php
include("db_connection.php");

$roll_no = "123456";
$name = "Rayan";
$email = "rayan@example.com";
$course = "CSE";
$year = "3";
$password_plain = "test123";
$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

$query = "INSERT INTO students (name, email, roll_no, course, year, password) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $name, $email, $roll_no, $course, $year, $password_hashed);

if ($stmt->execute()) {
    echo "✅ Test student inserted successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}
?>
