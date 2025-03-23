<?php

session_start();
include 'phak_math.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = trim($_POST['UserID']);
    $newPassword = $_POST['NewPassword'];
    $confirmPassword = $_POST['ConfirmPassword'];

    if ($newPassword != $confirmPassword) {
        echo "<script>alert('รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน'); window.history.back();</script>";
        exit();
    }

    if (strlen($newPassword) < 8 || !preg_match('/[^\w]/', $newPassword)) {
        echo "<script>alert('รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร และมีอักขระพิเศษอย่างน้อย 1 ตัว'); window.history.back();</script>";
        exit();
    }

    $sql = "SELECT * FROM user WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE user SET Password = ? WHERE UserID = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $hashedPassword, $userid);

        if ($stmtUpdate->execute()) {
            echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ กรุณาเข้าสู่ระบบ'); window.location.href = 'Login.html';</script>";
            exit();
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด ไม่สามารถเปลี่ยนรหัสผ่านได้'); window.location.href = 'Login.html';</script>";
        }
    } else {
        echo "<script>alert('ไม่พบบัญชีผู้ใช้นี้ในระบบ'); window.location.href = 'Register.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <style>
        .top-bar {
            background-color: #150B6E;
            /* สีของแถบด้านบน */
            height: 60px;
            /* ความสูงของแถบ */
            width: 100%;
            /* ครอบคลุมความกว้างทั้งหน้า */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        body {
            font-family: 'Noto Sans Thai', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        .form-container h1 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 16px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #150b6e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #2d209e;
        }
        .back-icon img {
            width: 30px;
            height: 30px;
            cursor: pointer;
            margin-left: 20px;
            margin-top: 15px;
            
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <!-- ปุ่มย้อนกลับเป็นสัญลักษณ์ "<" -->
        <a href="Login.html">
    <span class="back-icon">
                <img src="img/angle-left.png">
            </span>
        </a>
    </div>

<div class="form-container">
    <h1>เปลี่ยนรหัสผ่าน</h1>
    <form action="resetpassword.php" method="POST">
        <div class="form-group">
            <label for="UserID">ชื่อบัญชีผู้ใช้</label>
            <input type="text" id="UserID" name="UserID"  required>
        </div>
        <div class="form-group">
            <label for="NewPassword">รหัสผ่านใหม่</label>
            <input type="password" id="NewPassword" name="NewPassword" placeholder="ใส่รหัสผ่านใหม่" required>
        </div>
        <div class="form-group">
            <label for="ConfirmPassword">ยืนยันรหัสผ่าน</label>
            <input type="password" id="ConfirmPassword" name="ConfirmPassword" placeholder="ยืนยันรหัสผ่าน" required>
        </div>
        <input type="submit" value="เปลี่ยนรหัสผ่าน">
    </form>
</div>
</body>
</html>


