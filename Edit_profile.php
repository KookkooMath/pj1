<?php
session_start();
include 'phak_math.php';


if (!isset($_SESSION['UserID'])) {
    header("Location: Login.html");
    exit();
}

$userid = $_SESSION['UserID'];
$sql = "SELECT * FROM user WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_userid = $_POST['UserID'];
    $Title = $_POST['Title'];
    $Fname = $_POST['First_name'];
    $Lname = $_POST['Last_name'];
    $Email = $_POST['Email'];
    $Gender = $_POST['Gender'];
    $Aca = $_POST['Academic_pos'];
    $Adm = $_POST['Administrative_pos'];
    $Dep = $_POST['Department'];
    $Emp = $_POST['Emp_type'];

    $update_sql = "UPDATE user SET UserID = ?, Title = ?, First_name = ?, Last_name = ?, Email = ?, Gender = ?, Academic_pos = ?, Administrative_pos = ?, Department = ?, Emp_type = ? WHERE UserID = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssssss", $new_userid, $Title, $Fname, $Lname, $Email, $Gender,$Aca, $Adm, $Dep, $Emp, $userid);

    if ($update_stmt->execute()) {
        $_SESSION['UserID'] = $new_userid; // อัปเดต UserID ใน session ด้วย
        header("Location: Profile.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditProfile</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
        }
        /* สไตล์ของแถบด้านบน */
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

        
        /* เพิ่มพื้นที่เผื่อด้านบนสำหรับเนื้อหา */
        .content {
            text-align: center;
            color: #150B6E;
            font-size: 18px;
            padding-top: 60px;
        }

        /* จัดสไตล์ให้หน้า */
        .profile-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #f8f9fa;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #150B6E;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group select:focus {
            border-color: #2c32f3;
        }

        .checkbox-group {
            margin-bottom: 30px;
        }

        .checkbox-group label {
            display: inline-block;
            margin-right: 16px;
            font-weight: normal;
            color: #150B6E;
            font-weight: bold;
        }

        .form-container input[type="submit"] {
            width: 20%;
            padding: 10px;
            background-color: #150b6e;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            /* ทำให้ปุ่มเป็นบล็อก */
            margin: 0 auto;
            /* จัดให้อยู่กลาง */
            font-family: 'Noto Sans Thai', sans-serif;

        }

        .form-container input[type="submit"]:hover {
            background-color: #130b5e;
            transform: scale(1.05);
        }
        /* ปรับขนาด radio button */
        input[type="radio"] {
            appearance: none; /* ซ่อนดีไซน์ดั้งเดิม */
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            cursor: pointer;
            background-color: white;
            vertical-align: middle;
        }

        /* เมื่อเลือกให้มีจุดวงกลมด้านใน */
        input[type="radio"]:checked {
            background-color: #007bff;
            border-color: #0056b3;
        }

        input[type="radio"]::before {
            content: "";
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 0.2s ease-in-out;
            
        }

        /* แสดงจุดเมื่อเลือก */
        input[type="radio"]:checked::before {
            transform: translate(-50%, -50%) scale(1);
        }

        /* ปรับระยะห่างให้สวย */
        label {
            margin-right: 15px;
            font-size: 16px;
            cursor: pointer;
        }
        .back-icon img {
            width: 30px;
            height: 30px;
            cursor: pointer;
            margin-left: 20px;
            margin-top: 15px;
            
        }
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: white;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>

<body>
    <!-- แถบด้านบน -->
    <div class="top-bar">
        <!-- ปุ่มย้อนกลับเป็นสัญลักษณ์ "<" -->
        <a href="Profile.php">
         <span class="back-icon">
                <img src="img/angle-left.png">
            </span>
        </a>
    </div>

<div class="content">
            <h1>แก้ไขข้อมูลส่วนตัว</h1>
        </div>
    <div class="profile-container">
        
        <form method="post" action="">
            <div class="form-container">

                <div class="form-group">
                    <label>ชื่อบัญชีผู้ใช้</label>
                    <input type="text" name="UserID" value="<?php echo htmlspecialchars($user['UserID']); ?>"><br>
                </div>

                <div class="form-group">
                <label for="Title">คำนำหน้า</label>
                <select name="Title" >
                    <option value="" disabled selected required>เลือกคำนำหน้า</option>
                    <option value="นาย"<?php echo ($user['Title'] == 'นาย') ? 'selected' : ''; ?>>นาย</option>
                    <option value="นางสาว"<?php echo ($user['Title'] == 'นางสาว') ? 'selected' : ''; ?>>นางสาว</option>
                    <option value="นาง"<?php echo ($user['Title'] == 'นาง') ? 'selected' : ''; ?>>นาง</option>
                </select> 
            </div>

                <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="First_name" value="<?php echo htmlspecialchars($user['First_name']); ?>"><br>
                </div>
                
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" name="Last_name" value="<?php echo htmlspecialchars($user['Last_name']); ?>"><br>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>"><br>
                </div>

                <div class="form-group">
                    <label>เพศ</label>
                    <select name="Gender" id="Gender">
                        <option value="" disabled>เลือกเพศ</option> 
                        <option value="ชาย" <?php echo ($user['Gender'] == 'ชาย') ? 'selected' : ''; ?>>ชาย</option>
                        <option value="หญิง" <?php echo ($user['Gender'] == 'หญิง') ? 'selected' : ''; ?>>หญิง</option>
                    </select>                 
                </div>

                <div class="form-group">
                    <label>ตำแหน่งทางวิชาการ</label>
                    <input type="text" name="Academic_pos" value="<?php echo htmlspecialchars($user['Academic_pos']); ?>"><br>
                </div>

                <div class="form-group">
                    <label>ตำแหน่งทางบริหาร</label>
                    <input type="text" name="Administrative_pos" value="<?php echo htmlspecialchars($user['Administrative_pos']); ?>"><br>
                </div>

                <div class="form-group">
                    <label>ภาควิชา</label>
                    <select name="Department" id="Department">
                        <option value="" disabled>เลือกภาควิชา</option> 
                        <option value="คณิตศาสตร์" <?php echo ($user['Department'] == 'คณิตศาสตร์') ? 'selected' : ''; ?>>คณิตศาสตร์</option>
                        <option value="ฟิสิกส์" <?php echo ($user['Department'] == 'ฟิสิกส์') ? 'selected' : ''; ?>>ฟิสิกส์</option> 
                        <option value="เคมี" <?php echo ($user['Department'] == 'เคมี') ? 'selected' : ''; ?>>เคมี</option> 
                        <option value="ชีววิทยา" <?php echo ($user['Department'] == 'ชีววิทยา') ? 'selected' : ''; ?>>ชีววิทยา</option>
                        <option value="วิทยาการคอมพิวเตอร์" <?php echo ($user['Department'] == 'วิทยาการคอมพิวเตอร์') ? 'selected' : ''; ?>>วิทยาการคอมพิวเตอร์</option> 
                        <option value="สถิติ" <?php echo ($user['Department'] == 'สถิติ') ? 'selected' : ''; ?>>สถิติ</option> 
                        <option value="ศูนย์เครื่องมือวิทยาศาสตร์" <?php echo ($user['Department'] == 'ศูนย์เครื่องมือวิทยาศาสตร์') ? 'selected' : ''; ?>>ศูนย์เครื่องมือวิทยาศาสตร์</option>
                        <option value="K-DAI" <?php echo ($user['Department'] == 'K-DAI') ? 'selected' : ''; ?>>K-DAI</option> 
                    </select> 
                    <br>
                </div>

                <div class="checkbox-group">
                    <label for="Emp_type">ประเภทพนักงาน</label>

                    <input type="radio" id="emp1" name="Emp_type" value="ข้าราชการ" <?php echo ($user['Emp_type'] == 'ข้าราชการ') ? 'checked' : ''; ?>>
                    <label for="emp1">ข้าราชการ</label>

                    <input type="radio" id="emp2" name="Emp_type" value="พนักงาน" <?php echo ($user['Emp_type'] == 'พนักงาน') ? 'checked' : ''; ?>>
                    <label for="emp2">พนักงาน</label>
   
                </div>
                <input type="submit" value="บันทึก">
            </div>
    </div>

    </form>
    </div>

</body>

</html>