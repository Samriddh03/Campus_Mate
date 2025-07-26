<?php
$conn = new mysqli("localhost", "root", "", "bit_durg");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming roll number is stored in session
session_start();
$roll_no = $_SESSION['roll_no'] ?? '123456'; // fallback for testing

$sql = "SELECT * FROM student_details WHERE roll_no = '$roll_no'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Student record not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Details | BIT Durg</title>
    <style>
        body { font-family: 'Times New Roman', serif; background: #f4f7fa; margin: 0; }
        .container { max-width: 800px; margin: 50px auto; background: white; padding: 30px 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #002147; }
        table { width: 100%; border-collapse: collapse; font-size: 18px; }
        th, td { padding: 12px 15px; text-align: left; }
        tr:nth-child(even) { background-color: #f2f6fc; }
        .back-btn { margin-top: 30px; display: inline-block; background-color: #002147; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .back-btn:hover { background-color: #00162f; }
    </style>
</head>
<body>
<div class="container">
    <h2>Student Profile Details</h2>
    <table>
        <tr><th>Name</th><td><?= $row['name'] ?></td></tr>
        <tr><th>Roll Number</th><td><?= $row['roll_no'] ?></td></tr>
        <tr><th>Registration Number</th><td><?= $row['registration_no'] ?></td></tr>
        <tr><th>Course</th><td><?= $row['course'] ?></td></tr>
        <tr><th>Branch</th><td><?= $row['branch'] ?></td></tr>
        <tr><th>Year</th><td><?= $row['year'] ?></td></tr>
        <tr><th>Semester</th><td><?= $row['semester'] ?></td></tr>
        <tr><th>Gender</th><td><?= $row['gender'] ?></td></tr>
        <tr><th>Date of Birth</th><td><?= $row['dob'] ?></td></tr>
        <tr><th>Contact Number</th><td><?= $row['contact_no'] ?></td></tr>
        <tr><th>Email</th><td><?= $row['email'] ?></td></tr>
        <tr><th>Address</th><td><?= $row['address'] ?></td></tr>
        <tr><th>Father's Name</th><td><?= $row['father_name'] ?></td></tr>
        <tr><th>Mother's Name</th><td><?= $row['mother_name'] ?></td></tr>
        <tr><th>Blood Group</th><td><?= $row['blood_group'] ?></td></tr>
        <tr><th>Category</th><td><?= $row['category'] ?></td></tr>
    </table>
    <a href="student_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>
