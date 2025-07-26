<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $roll = $_POST["roll_no"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $course = $_POST["course"];
    $year = $_POST["year"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encrypt the password

    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "", "bit_durg");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into database
    $sql = "INSERT INTO students (roll_no, name, email, course, year, password)
            VALUES ('$roll', '$name', '$email', '$course', '$year', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Student registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
