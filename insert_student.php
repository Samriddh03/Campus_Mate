<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bit_durg"; // Your database

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$roll_no = $_POST['roll_no'];
$name = $_POST['name'];
$email = $_POST['email'];
$course = $_POST['course'];
$year = $_POST['year'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Prevent duplicate roll numbers
$check = "SELECT * FROM students WHERE roll_no = '$roll_no'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "Roll Number already registered. <a href='register.php'>Try again</a>";
} else {
    $sql = "INSERT INTO students (roll_no, name, email, course, year, password)
            VALUES ('$roll_no', '$name', '$email', '$course', '$year', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. <a href='login.php'>Click here to login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
