<?php
session_start();
include("db_connection.php");

// Check login
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch student details
$student_query = $conn->prepare("SELECT * FROM students WHERE id = ?");
$student_query->bind_param("i", $student_id);
$student_query->execute();
$student_result = $student_query->get_result();
$student = $student_result->fetch_assoc();

// Fetch attendance records
$attendance_query = $conn->prepare("SELECT date, status FROM attendance WHERE student_id = ? ORDER BY date DESC");
$attendance_query->bind_param("i", $student_id);
$attendance_query->execute();
$attendance_result = $attendance_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Record</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .header {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .info p {
            margin: 4px 0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #999;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #001933;
            color: white;
        }
        .back {
            margin-top: 20px;
        }
        .back a {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #001933;
            border-radius: 5px;
        }
        .back a:hover {
            background-color: #003366;
        }
    </style>
</head>
<body>

<div class="header">Attendance Record</div>

<div class="info">
    <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
    <p><strong>Roll No:</strong> <?php echo $student['roll_no']; ?></p>
    <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
    <p><strong>Year:</strong> <?php echo $student['year']; ?></p>
</div>

<table>
    <tr>
        <th>Date</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $attendance_result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
    <?php } ?>
</table>

<div class="back">
    <a href="student_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
