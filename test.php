<?php
session_start();

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if (isset($_SESSION['student_id'])) {
    echo "✅ Session is working. Student ID: " . $_SESSION['student_id'];
} else {
    echo "❌ Session not found.";
}
?>
