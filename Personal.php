<?php
// เริ่ม session เพื่อเข้าถึงข้อมูลของผู้ใช้ที่เข้าสู่ระบบ
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION['UserID'])) {
    header("Location: Login.html"); // เปลี่ยนเส้นทางไปหน้าเข้าสู่ระบบถ้าไม่ได้เข้าสู่ระบบ
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phak_math";


$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลผู้ใช้จากตาราง User โดยใช้ user_id ที่เก็บใน session
$userid = $_SESSION['UserID'];
$sql = "SELECT * FROM user WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // ดึงข้อมูลของผู้ใช้
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>

