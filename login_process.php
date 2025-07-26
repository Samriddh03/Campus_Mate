<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "", "bit_durg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get roll number and password from form
$roll_no = $_POST['roll_no'];
$password = $_POST['password'];

// Query to fetch student with this roll number
$sql = "SELECT * FROM students WHERE roll_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $roll_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();

    // Check password using password_verify
    if (password_verify($password, $student['password'])) {
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];
        header("Location: student_dashboard.php"); // Redirect after login
        exit();
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Student not found.";
}
?>
