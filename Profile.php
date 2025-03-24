

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <style>
        /* สไตล์ของแถบด้านบน */
        .top-bar {
            display: flex;
	align-items: center;
	justify-content: space-between;
	background: linear-gradient(90deg, #f57c00, #ff9800);
	padding: 15px 30px;
	box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
	position: fixed;
	width: 100%;
	top: 0;
	z-index: 1000;
	transition: all 0.3s ease-in-out;
    height: 7%;
        }

        body {

            font-family: 'Noto Sans Thai', sans-serif;
            background: linear-gradient(180deg, #f57c00, #ffffff);
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            
        }
        /* เพิ่มพื้นที่เผื่อด้านบนสำหรับเนื้อหา */
        .content {
            margin-top: 3%;
            text-align: center;
            color: #ffffff;
            font-size: 40px;
            text-shadow: black 0px 0px 3px;

        }
        /* จัดสไตล์ให้หน้า */
        .profile-container {
            width: 400px;
            margin: 10px;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #f8f9fa;
        }
        
        .profile-info {
            margin-bottom: 20px;
            font-size: 20px;
            color: #150b6e;
            text-align: left;

        }
        .profile-info label {
            font-weight: bold;
            width: 180px;
            color: #150b6e;
        }
        .edit-button {
            padding: 15px 25px;
            background: linear-gradient(90deg, #f57c00, #ff9800);
            color: white;
            border: none;
            border-radius: 18px;
            cursor: pointer;
            font-family: 'Noto Sans Thai', sans-serif;
            font-size: 30px;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s ease;
            background: linear-gradient(90deg, #ff9800, #f57c00);
            width: 70px;
            height: 40px;
            margin: 20px auto; 
        }
        .edit-button:hover {
            background-color: #130b5e;
            transform: scale(1.05);
            box-shadow: #000000 0px 0px 10px;
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
    <a href="TeachingInformation.php">
    <span class="back-icon">
                <img src="img/angle-left.png">
            </span>
        </a>
    </div>
    
<?php include 'Personal.php'; 


    if (!isset($_SESSION['UserID'])) {
        echo "<script>
            alert('กรุณาเข้าสู่ระบบก่อน');
            window.location.href = 'Login.html';
          </script>";
    exit(); 
    }
?> 

    <div class="content">
        <h1>ข้อมูลส่วนตัว</h1></div>

    <div class="profile-container">
    <div class="profile-info">
        <label>ชื่อบัญชีผู้ใช้:</label>
        <span><?php echo htmlspecialchars($user['UserID']); ?></span>
    </div>
    
    <div class="profile-info">
        <label>ชื่อ-นามสกุล:</label>
        <span><?php echo htmlspecialchars($user['Title'])," ",($user['First_name']),"  ",($user['Last_name']); ?></span>
    </div>
    
    <div class="profile-info">
        <label>Email:</label>
        <span><?php echo htmlspecialchars($user['Email']); ?></span>
    </div>

    <div class="profile-info">
        <label>เพศ:</label>
        <span><?php echo htmlspecialchars($user['Gender']); ?></span>
    </div>
    
    <div class="profile-info">
        <label>ตำแหน่งทางวิชาการ:</label>
        <span><?php echo htmlspecialchars($user['Academic_pos']); ?></span>
    </div>

    <div class="profile-info">
        <label>ตำแหน่งทางบริหาร:</label>
        <span><?php echo htmlspecialchars($user['Administrative_pos']); ?></span>
    </div>

    <div class="profile-info">
        <label>ภาควิชา:</label>
        <span><?php echo htmlspecialchars($user['Department']); ?></span>
    </div>
    
    <div class="profile-info">
        <label>ประเภทพนักงาน:</label>
        <span><?php echo htmlspecialchars($user['Emp_type']); ?></span>
    </div>
    </div>
    
</div>
    
    <!-- ปุ่มสำหรับแก้ไขข้อมูล -->
    <a href="Edit_profile.php" class="edit-button">แก้ไข</a>
</body>
<script>
        // ฟังก์ชันสำหรับเปิด/ปิดเมนู
        function toggleMenu() {
            const menu = document.getElementById("dropdownMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // ปิดเมนูเมื่อคลิกนอกเมนู
        window.onclick = function (event) {
            const menu = document.getElementById("dropdownMenu");
            if (!event.target.closest('.menu-icon')) {
                if (menu.style.display === "block") {
                    menu.style.display = "none";
                }
            }
        }
    </script>


</html>
