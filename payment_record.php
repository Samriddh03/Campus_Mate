<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch payment record
$sql = "SELECT * FROM payments WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Record | BIT Durg</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        h2 {
            color: #002147;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #002147;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>
    <h2>Payment Records</h2>
    <table>
        <tr>
            <th>Transaction ID</th>
            <th>Amount (₹)</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['transaction_id']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No payment records found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
