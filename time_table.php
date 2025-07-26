<?php
session_start();
include("db_connection.php"); // Make sure this connects to your DB

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

// Get the student course and year from session or DB
$student_id = $_SESSION['student_id'];
$sql = "SELECT course, year FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$course = $student['course'];
$year = $student['year'];

// Fetch timetable for student's course and year
$sql = "SELECT * FROM time_table WHERE course = ? AND year = ? ORDER BY 
FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $course, $year);
$stmt->execute();
$timetable = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Time Table | BIT Durg</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background: #f4f7fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 95%;
            max-width: 1000px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #002147;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #002147;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .back-btn {
            display: inline-block;
            margin-top: 10px;
            background: #002147;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #003366;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h2>Your Weekly Time Table</h2>

        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Slot 1</th>
                    <th>Slot 2</th>
                    <th>Slot 3</th>
                    <th>Slot 4</th>
                    <th>Slot 5</th>
                    <th>Slot 6</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $timetable->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['day']; ?></td>
                        <td><?php echo $row['slot_1']; ?></td>
                        <td><?php echo $row['slot_2']; ?></td>
                        <td><?php echo $row['slot_3']; ?></td>
                        <td><?php echo $row['slot_4']; ?></td>
                        <td><?php echo $row['slot_5']; ?></td>
                        <td><?php echo $row['slot_6']; ?></td>
                    </tr>
                    
                <?php endwhile; ?>
            </tbody>
        </table>
        <a class="back-btn" href="student_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
