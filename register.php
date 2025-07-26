<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #003366 50%, #ffffff 50%);
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .form-card {
            background-color: white;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            z-index: 2;
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #003366;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            font-weight: 500;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #003366;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background-color: #003366;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #001f4d;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="register_process.php" method="POST" class="form-card">
            <h2>Student Registration</h2>

            <label for="roll_no">Roll Number:</label>
            <input type="text" name="roll_no" required>

            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="course">Course:</label>
            <input type="text" name="course" required>

            <label for="year">Year:</label>
            <input type="number" name="year" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
