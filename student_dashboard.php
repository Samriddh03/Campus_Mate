<?php
session_start();
include("db_connection.php");

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch student details
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch attendance records
$query = "SELECT date, status FROM attendance WHERE student_id = ? ORDER BY date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$attendance_result = $stmt->get_result();

// Fetch marks
$query = "SELECT subject, marks_obtained, total_marks FROM marks WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$marks_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | BIT Durg</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 180px;
            position: fixed;
            height: 100%;
            background-color: #112B3C;
            color: white;
            padding: 20px;
        }
        .dashboard {
            margin-left: 180px;
            padding: 20px;
        }
        .main {
            margin-left: 250px;
            padding: 30px;
        }
        .header {
            background-color: #002147;
            color: white;
            padding: 20px;
            font-size: 26px;
            font-weight: bold;
            text-align: center;
        }
        .profile {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .card {
            display: inline-block;
            width: 200px;
            height: 120px;
            margin: 15px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: background-color 0.3s;
        }
        .card:hover {
            cursor: pointer;
            background-color: #eaeaea;
        }
        .card i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #1f2937;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #002147;
            color: white;
        }
        .logout-btn {
    display: inline-block;
    background-color: #dc3545; /* Bootstrap red */
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.logout-btn:hover {
    background-color: #c82333;
    transform: translateY(-2px);

}
        a.card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>BIT DURG</h2>
    <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
    <p><strong>Roll No:</strong> <?php echo $student['roll_no']; ?></p>
    <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
    <p><strong>Year:</strong> <?php echo $student['year']; ?></p>
</div>

<div class="main">
    <div class="header">Welcome, <?php echo $student['name']; ?>!</div>

    <!-- Dashboard Cards -->
    <div class="profile">
        <a href="view_details.php" class="card-link">
        <div class="card"><i class="fas fa-user"></i><br>View Details</div>
        <a href="attendance.php" class="card-link">
            <div class="card"><i class="fas fa-calendar-check"></i><br>Attendance</div>
        </a>
        <div class="card"><i class="fas fa-file-alt"></i><br>Exam Form</div>
        <div class="card"><i class="fas fa-download"></i><br>Admit Card</div>
        <a href="marks.php" class="card-link">
        <div class="card"><i class="fas fa-chart-line"></i><br>CT Marks</div>
        </a>
        <a href="payment_record.php" class="card-link">
    <div class="card"><i class="fas fa-money-check-alt"></i><br>Fee</div>
</a>


        <a href="time_table.php" class="card-link">
        <div class="card"><i class="fas fa-clock"></i><br>Time Table</div>
        </a>
        <a href="syllabus.php" class="card-link">
        <div class="card"><i class="fas fa-book"></i><br>Syllabus</div>
    
    </div>

    </table>

    <div style="text-align: center; margin-top: 40px;">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

</div>

</body>
</html>
