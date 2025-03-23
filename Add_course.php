<?php
include 'phak_math.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseID = $_POST['CourseID'];
    $course_name = $_POST['Course_name'];
    $credit_total = $_POST['Credit_total'];
    $credit_lec = $_POST['Credit_lecture'];
    $credit_lab = $_POST['Credit_lab'];
    $credit_independent = $_POST['Credit_independent'];

    $sql = "INSERT INTO courses (CourseID, Course_name, Credit_total, Credit_lecture, Credit_lab, Credit_independent) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiii", $courseID, $course_name, $credit_total, $credit_lec, $credit_lab, $credit_independent);
    
    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มวิชาสำเร็จ!'); window.location.href='TeachingInformation.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด!');</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มวิชา</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
   
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
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

        
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            display: block;
            width: calc(100% - 20px);
            padding: 12px;
            margin: 10px auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
            font-family: 'Noto Sans Thai', sans-serif;
        }
        input:focus {
            border-color: #150B6E;
            outline: none;
        }
        .submit-button {
            background-color: #150B6E;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            width: 150px ;
            margin-top: 20px;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .submit-button:hover {
            background-color: #130b5e;
            transform: scale(1.05);
        }
        
        .menu-icon img {
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
<a href="TeachingInformation.php">
<span class="menu-icon">
                <img src="img/angle-left.png">
            </span>
        </a>
</div>
    <div class="container">
        <h2>เพิ่มวิชาใหม่</h2>
        <form action="" method="POST">
            <input type="text" name="CourseID" placeholder="รหัสวิชา" required>
            <input type="text" name="Course_name" placeholder="ชื่อวิชา" required>
            <input type="number" name="Credit_total" placeholder="หน่วยกิตรวม" step="1" required>
            <input type="number" name="Credit_lecture" placeholder="หน่วยกิตทฤษฎี" step="1" required>
            <input type="number" name="Credit_lab" placeholder="หน่วยกิตปฏิบัติ" step="1" required>
            <input type="number" name="Credit_independent" placeholder="หน่วยกิตศึกษาด้วยตนเอง" step="1" required>
            <button type="submit" class="submit-button" >บันทึกข้อมูล</button>
        </form>
    </div>
</body>
</html>
