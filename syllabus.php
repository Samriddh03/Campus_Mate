<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

// DB Connection
$conn = new mysqli("localhost", "root", "", "bit_durg");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM syllabus";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Syllabus | BIT Durg</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #001f3f;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #001f3f;
            color: white;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #001f3f;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .back-btn:hover {
            background-color: #003366;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>3rd Year CSE Syllabus</h2>

    <table>
        <tr>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Credits</th>
            <th>Semester</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['subject_code']); ?></td>
                    <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['credits']); ?></td>
                    <td><?php echo htmlspecialchars($row['semester']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No syllabus data found.</td></tr>
        <?php endif; ?>
    </table>

    <a href="student_dashboard.php" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
</div>

</body>
</html>

<?php $conn->close(); ?>
