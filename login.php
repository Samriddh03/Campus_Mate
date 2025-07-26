<?php
session_start();
include("db_connection.php");
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST["roll_no"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM students WHERE roll_no = ?");
    $stmt->bind_param("s", $roll_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['roll_no'] = $roll_no;
            header("Location: student_dashboard.php");
            exit();
        } else {
            $msg = "❌ Invalid password.";
        }
    } else {
        $msg = "❌ Roll number not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | BIT Durg</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            background-color: #f8f9fa;
        }

        .video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
            filter: brightness(0.6);
        }

        .header {
            background-color: #002147;
            color: white;
            text-align: center;
            padding: 35px;
            font-size: 30px;
            font-weight: bold;
        }

        nav {
            background-color: #00112d;
            padding: 0 30px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            display: block;
            padding: 20px;
            color: white;
            text-decoration: none;
            font-size: 22px;
        }

        nav ul li a:hover {
            background-color: #334766;
        }

        nav ul li ul {
            display: none;
            position: absolute;
            top: 60px;
            left: 0;
            background-color: #002147;
            flex-direction: column;
            min-width: 200px;
            z-index: 1000;
        }

        nav ul li:hover ul {
            display: flex;
        }

        nav ul li ul li a {
            padding: 12px 20px;
            border-top: 1px solid #334766;
        }

        nav ul li ul li a:hover {
            background-color: #445a7a;
        }

        .sidebar {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: #002147;
            padding: 10px;
            border-radius: 5px 0 0 5px;
        }

        .sidebar a {
            display: block;
            color: white;
            background: #002147;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .sidebar a:hover {
            background: #00112d;
        }

        .container {
            background: whitesmoke;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            width: 330px;
            text-align: center;
            margin: 50px auto;
        }

        select, input, button {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            border: 3px solid #ccc;
        }

        button {
            background-color: #002147;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #00112d;
        }

        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Background video -->
<video autoplay muted loop class="video-background">
    <source src="videos/college_bg.mp4" type="video/mp4">
</video>

<div class="header">
    Campus Mate
</div>

<!-- Navbar -->
<nav>
    <ul>
        <li><a href="#">About</a>
            <ul>
                <li><a href="#">Vision & Mission</a></li>
                <li><a href="#">Leadership</a></li>
                <li><a href="#">History</a></li>
            </ul>
        </li>
        <li><a href="#">Academics</a>
            <ul>
                <li><a href="#">Programs</a></li>
                <li><a href="#">Academic Calendar</a></li>
                <li><a href="#">Regulations</a></li>
            </ul>
        </li>
        <li><a href="#">Admission</a>
            <ul>
                <li><a href="#">UG Admission</a></li>
                <li><a href="#">PG Admission</a></li>
            </ul>
        </li>
        <li><a href="#">Departments</a>
            <ul>
                <li><a href="#">CSE</a></li>
                <li><a href="#">ECE</a></li>
                <li><a href="#">ME</a></li>
            </ul>
        </li>
        <li><a href="#">Placement</a>
            <ul>
                <li><a href="#">Statistics</a></li>
                <li><a href="#">Companies</a></li>
            </ul>
        </li>
        <li><a href="#">Campus Life</a>
            <ul>
                <li><a href="#">Hostel</a></li>
                <li><a href="#">Clubs</a></li>
            </ul>
        </li>
        <li><a href="#">Connect</a>
            <ul>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Alumni</a></li>
            </ul>
        </li>
        <li><a href="#">Blogs</a></li>
    </ul>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <a href="#">News & Events</a>
    <a href="#">☎ 0788-2359424</a>
    <a href="payment_record.php">Online Payment </a>
    <a href="#">Examination</a>
    <a href="#">Notices</a>
</div>

<!-- Login Form -->
<div class="container">
    <h2>Student Login</h2>
    <?php if ($msg != "") echo "<div class='error-msg'>$msg</div>"; ?>
    <form method="POST" action="login_process.php">
        <label for="roll_no">Roll Number:</label>
        <input type="text" id="roll_no" name="roll_no" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <div style="text-align: center; margin-top: 10px;">
    <a href="register.php" style="text-decoration: none; color: #003366;">New Registration?</a>
</div>



        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
