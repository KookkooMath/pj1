<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลภาระงานสอน</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       body {
    font-family: 'Noto Sans Thai', sans-serif;
    background-color: #f3f3f3;
}

.top-bar {
    background-color: #150B6E;
    height: 60px;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    padding: 0 20px;
    justify-content: flex-end;  /* ให้เนื้อหาทั้งหมดอยู่ขวาสุด */
}

.add-button {
    position: relative;
    color: white;
    font-size: 40px;
    border: none;
    background: none;
    cursor: pointer;
    margin-right: 30px;  /* เว้นระยะห่างจากไอคอน */
}



.menu-container {
    position: relative;
    display: flex;
    align-items: center;
}

.menu-icon img {
    width: 40px;
    height: 40px;
    cursor: pointer;
}

.add-icon img {
    width: 40px;
    height: 40px;
    cursor: pointer;
    margin-right: 30px;
}
.dropdown-menu {
    display: none;
    position: absolute;
    top: 60px;
    right: 20px;
    background-color: white;
    min-width: 150px;
    border: 1px solid #ddd;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    z-index: 1001;
}

.dropdown-menu a {
    color: black;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    border-bottom: 1px solid #ddd;
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}
.dropdown-menu {
    display: none;
}

.dropdown-menu.show {
    display: block;
}
.content-container {
    margin-top: 80px;
    padding: 20px;
}

.button {
    display: block;
    width: 10%;
    padding: 10px;
    text-align: center;
    color: white;
    background-color: #150b6e;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 18px;
    text-decoration: none;
    margin: 0 auto;
}

.button:hover {
    background-color: #130b5e;
    transform: scale(1.05);
}


    </style>
</head>

<body>
    <div class="top-bar">
        
        <span class="add-icon" onclick="toggleMenu('dropdownMenu1')">
    <img src="img/add.png" >
</span>
<div class="dropdown-menu" id="dropdownMenu1">
    <a href="Add_course.php">เพิ่มวิชา</a>
    <a href="Edit_course.php">แก้ไขวิชา</a>
</div>

<span class="menu-icon" onclick="toggleMenu('dropdownMenu2')">
    <img src="img/user.png" alt="Profile Icon">
</span>
<div class="dropdown-menu" id="dropdownMenu2">
    <a href="Profile.php">โปรไฟล์</a>
    <a href="Logout.php">ออกจากระบบ</a>
</div>

    </div>

    <script>
       function toggleMenu(menuId) {
    var menu = document.getElementById(menuId);
    menu.classList.toggle('show');
}

// Close the dropdown menu when clicking outside of it
window.onclick = function(event) {
    var menus = document.querySelectorAll('.dropdown-menu');
    menus.forEach(function(menu) {
        // Check if the click is outside the dropdown and menu icon
        if (!menu.contains(event.target) && !event.target.closest('.menu-icon') && !event.target.closest('.add-icon')) {
            menu.classList.remove('show');
        }
    });
};



    </script>

    <div class="content-container">
        
        <?php
        include 'phak_math.php';

        session_start(); // เปิด session
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        if (!isset($_SESSION['UserID'])) {
            die("กรุณาเข้าสู่ระบบ"); // หรือเปลี่ยนเส้นทางไปหน้า login
        }

        $userid = $_SESSION['UserID']; // ดึงค่า UserID ของผู้ใช้ที่ล็อกอิน

            // ถ้ามีค่า year และ term ใน URL (กดเลือกปี)
            if (isset($_GET['Year']) && isset($_GET['Term'])) {
            $_SESSION['Year'] = $_GET['Year'];
            $_SESSION['Term'] = $_GET['Term'];
        }

            // ใช้ค่าปีล่าสุดที่เลือก ถ้าไม่มีให้ใช้ค่าปัจจุบัน
            $year = isset($_SESSION['Year']) ? $_SESSION['Year'] : date("Y") + 543;
            $term = isset($_SESSION['Term']) ? $_SESSION['Term'] : 1;



            $Title = isset($_GET['Title']) ? $_GET['Title'] : '';
            $Fname = isset($_GET['First_name']) ? $_GET['First_name'] : '';
            $Lname = isset($_GET['Last_name']) ? $_GET['Last_name'] : '';
            $Dep = isset($_GET['Department']) ? $_GET['Department'] : '';


            $sql = "SELECT  Title, First_name, Last_name, Department FROM user WHERE UserID = ?";
            $stmt1 = $conn->prepare($sql);
            $stmt1->bind_param("s", $userid);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            
            // ตรวจสอบว่าพบข้อมูลหรือไม่
            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                $Title = $row1["Title"];
                $Fname = $row1["First_name"];
                $Lname = $row1["Last_name"];
                $Dep = $row1["Department"];
            } else {
                $Title = "ไม่พบคำนำหน้า";
                $Fname = "ไม่พบชื่อ";
                $Lname = "ไม่พบนามสกุล";
                $Dep = "ไม่พบภาควิชา";
            }
            
            $stmt1->close();


        $stmt = $conn->prepare("SELECT teach.CourseID, courses.Course_name, teach.Year, teach.Term, teach.Section, teach.Course_day
            FROM teach
            JOIN courses ON teach.CourseID = courses.CourseID
            WHERE teach.Year = ? AND teach.Term = ? AND teach.UserID = ?
            ORDER BY FIELD(Course_day, 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์')");
        $stmt->bind_param("iis", $year, $term, $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        $courses_by_day = [];
        while ($row = $result->fetch_assoc()) {
            $courses_by_day[$row['Course_day']][] = $row;
        }


        ?>

        <form action="" method="GET" class="mb-4">
        <div class="flex items-center gap-4 mb-4">
    <div class="flex items-center gap-2">
        <label class="font-medium">เลือกปีการศึกษาปัจจุบัน:</label>
        <input type="number" name="Year" value="<?= $year ?>" min="2500" onchange="this.form.submit()" class="p-2 border rounded w-24 text-center">
    </div>
    <div class="flex items-center gap-2">
        <label class="font-medium">เลือกภาคเรียน:</label>
        <select name="Term" onchange="this.form.submit()" class="p-2 border rounded">
            <option value="1" <?= $term == 1 ? 'selected' : '' ?>>1</option>
            <option value="2" <?= $term == 2 ? 'selected' : '' ?>>2</option>
        </select>
    </div>
</div>


        </form>

        <h1 class="text-center text-xl font-family: 'Noto Sans Thai', sans-serif; mb-4">ระบบจัดการภาระงานอาจารย์ ปีการศึกษา <?= $year ?> ภาคเรียนที่ <?= $term ?></h1>

        <!-- <h2 class="text-center text-xl font-bold mb-4"></h2> -->
        <h2 class="text-center text-xl font-family: 'Noto Sans Thai', sans-serif; mb-4"><?= $Title ?> <?= $Fname ?>  <?= $Lname ?> ภาควิชา <?= $Dep ?></h2>


        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mb-4 ml-4" onclick="showYearPopup()">เลือกข้อมูลปีเก่า</button>
        
        <button class="bg-red-500 text-white py-2 px-4 rounded-lg mb-4" onclick="toggleDeleteMode()">ลบข้อมูล</button>
        

        


        <div class="grid grid-cols-7 gap-4">
            <?php
            $days = ['จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์'];
            foreach ($days as $course_day):
            ?>
                <div>
                    <div class="bg-[#150B6E] text-white text-center py-2 rounded-lg font-bold"> <?= $course_day ?> </div>
                    <div class="space-y-2 mt-2">
                        <a href='Add_teaching.php?Year=<?= $year ?>&Term=<?= $term ?>&Course_day=<?= $course_day ?>' class='block bg-gray-300 p-2 rounded-lg text-center hover:bg-gray-400 transition'>เพิ่มข้อมูล</a>
                        <?php if (!empty($courses_by_day[$course_day])): ?>
                            <?php foreach ($courses_by_day[$course_day] as $course): ?>
                                <div class="bg-white p-4 rounded-lg shadow-md hover:bg-gray-200 transition relative flex-col items-center justify-center text-center ">
                                    <a href='Update_teach.php?Year=<?= $year ?>&Term=<?= $term ?>&CourseID=<?= $course['CourseID'] ?>&Course_day=<?= $course_day ?>&Section=<?= $course['Section'] ?>' class='block'>
                                        <div class="font-bold text-lg "> <?= $course['CourseID'] ?> </div>
                                        <div class="text-sm"> <?= $course['Course_name'] ?> </div>
                                        <div class="text-sm">กลุ่ม <?= $course['Section'] ?> </div>
                                    </a>
                                    <button class="delete-btn text-red-500 hover:text-red-700 absolute top-2 right-2 hidden" onclick="confirmDelete('<?= $year ?>','<?= $term?>','<?= $course['CourseID'] ?>', '<?= $course_day ?>','<?= $course['Section'] ?>')">✖</button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="bg-gray-200 p-4 rounded-lg text-center">ว่าง</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>

<!-- Popup Form -->
<div id="yearPopup" class="fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">คัดลอกข้อมูลจากปีเก่า</h2>
        <form action="copy_data.php" method="POST">
        <div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label>ปีการศึกษาเก่า:</label>
        <select name="copyYear" class="w-full p-2 border rounded">
            <?php
            $sql_year = "SELECT DISTINCT Year FROM teach ORDER BY Year DESC";
            $result_year = $conn->query($sql_year);
            while ($row_year = $result_year->fetch_assoc()):
            ?>
                <option value="<?= $row_year['Year'] ?>"><?= $row_year['Year'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div>
        <label>ภาคเรียนเก่า:</label>
        <select name="copyTerm" class="w-full p-2 border rounded">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label>ปีการศึกษาใหม่:</label>
        <input type="number" name="newYear" value="<?= $year ?>" class="w-full p-2 border rounded">
    </div>
    <div>
        <label>ภาคเรียนใหม่:</label>
        <select name="newTerm" class="w-full p-2 border rounded">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>
</div>

<div class="flex justify-end">
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">ยืนยันคัดลอก</button>
    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg ml-2 hover:bg-red-600" onclick="closeYearPopup()">ยกเลิก</button>
</div>

        </form>
    </div>
</div>

<a href="Export_to_excel.php" class="button">📥 ดาวน์โหลด Excel</a>



        <script>
            function toggleDeleteMode() {
                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.classList.toggle('hidden');
                });
            }

            function confirmDelete(year, term, courseID, course_day, section) {
            if (confirm("ต้องการลบรายวิชานี้หรือไม่?")) {
                window.location.href = `delete_teach.php?Year=${year}&Term=${term}&CourseID=${courseID}&Course_day=${course_day}&Section=${section}`;
                }
            }
            // ฟังก์ชันในการเปิดและปิด popup
            function showYearPopup() {
                document.getElementById('yearPopup').classList.remove('hidden');
            }

            function closeYearPopup() {
                document.getElementById('yearPopup').classList.add('hidden');
            }
            
        </script>

        <?php $conn->close(); ?>
    
</body>
</html>
