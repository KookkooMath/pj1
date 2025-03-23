<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรายวิชาสอน</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f3f3f3;
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

        /* สไตล์ของฟอร์ม */
        form {
            display: inline;
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 15px;
            margin: 3px 0;
            display: block;
            width: 500px;
            box-sizing: border-box;
            font-family: 'Noto Sans Thai', sans-serif;
        }


        input[type="number"],
        input[type="time"] {
            width: 50px;
            height: 20px;
            text-align: center;
            font-size: 18px;
            border: none;
            color: #150B6E;
            /* background-color: #ddd; */
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .weeks {
            background-color: #ddd;
            padding: 15px;
            border-radius: 8px;
        }

        .checkbox-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .checkbox-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 5px;
        }

        .checkbox-container span {
            margin-bottom: 5px;
            font-size: 18px;
            color: #150B6E;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: #150B6E;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        label {
            margin: 5px;
        }

        .disabled {
            background-color: #ddd;
            pointer-events: none;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            gap: 5px;
        }

        .form-group label {
            min-width: 100px;
            /* ปรับขนาดให้ label เท่ากัน */
            text-align: right;
            /* จัด label ให้อยู่ชิดขวา */
            font-size: 18px;
        }

        .form-group input,
        .form-group select {
            flex: 2;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .submit-button {
            background-color: #150B6E;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            width: 100px;
            margin-top: 20px;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .submit-button:hover {
            background-color: #130b5e;
            transform: scale(1.05);
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

        .form-container {
            background-color: white;
            /* พื้นหลังสีขาว */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 100%;
            width: 90%;
            margin: auto;
            margin-top: 100px;
            text-align: center;
            color: #150B6E;
            font-size: 18px;
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

    <?php
            include 'phak_math.php';

            $year = isset($_GET['Year']) ? $_GET['Year'] : '';
            $term = isset($_GET['Term']) ? $_GET['Term'] : '';   
            $courseID = isset($_GET['CourseID']) ? $_GET['CourseID'] : '';
            $course_day = isset($_GET['Course_day']) ? $_GET['Course_day'] : '';
            $section = isset($_GET['Section']) ? $_GET['Section'] : '';
                   
             // ใช้ JOIN เพื่อดึงข้อมูลจากทั้งตาราง teach และ courses
             $stmt = $conn->prepare("SELECT teach.*, courses.Course_name, courses.Credit_total, courses.Credit_lecture, courses.Credit_lab, courses.Credit_independent 
             FROM teach 
             INNER JOIN courses ON teach.CourseID = courses.CourseID
             WHERE teach.Year = ? AND teach.Term = ? AND teach.CourseID = ? AND teach.Course_day = ? AND teach.Section = ?");
$stmt->bind_param("iissi", $year, $term, $courseID, $course_day, $section);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบว่ามีข้อมูลที่ดึงมา
if ($result->num_rows > 0) {
$data = $result->fetch_assoc();

// ตรวจสอบค่าที่ดึงมา
if (isset($data['Credit_total'], $data['Credit_lecture'], $data['Credit_lab'], $data['Credit_independent'])) {
// คำนวณ Credit_combined
$Credit_combined = "{$data['Credit_total']}({$data['Credit_lecture']}-{$data['Credit_lab']}-{$data['Credit_independent']})";
} else {
$Credit_combined = 'ข้อมูลไม่ครบถ้วน';
}
} else {
$data = []; // กรณีไม่พบข้อมูล
$Credit_combined = 'ไม่พบข้อมูล';
}

$stmt->close();
$conn->close();
        ?>




    <div class="form-container">
        <h2>แก้ไขข้อมูลรายวิชา วัน
            <?=$course_day?> ปีการศึกษา
            <?= $year ?> ภาคเรียนที่
            <?= $term ?>
        </h2>

        <form id="details" action="Add_data.php" method="POST">
            <input type="hidden" name="Year" value="<?= $year ?>">
            <input type="hidden" name="Term" value="<?= $term ?>">
            <input type="hidden" name="Course_day" value="<?= $course_day ?>">

            <div class="form-group">

                <label for="CourseID">รหัสวิชา</label>
                <input type="text" name="CourseID" id="CourseID" value="<?= $data['CourseID'] ?>" readonly>


                <label for="Course_name">ชื่อวิชา</label>
                <input type="text" id="Course_name" name="Course_name" value="<?= $data['Course_name'] ?>" readonly>
            
                <label for="Credit_combined">หน่วยกิต</label>
                <input type="text" id="Credit_combined" name="Credit_combined" value="<?= htmlspecialchars($Credit_combined) ?>" readonly>
            
            </div>


            <div class="form-group">

                <label for="Course_time_start_lecture">ทฤษฎีเรียนเริ่มเวลา</label>
                <input type="time" id="Course_time_start_lecture" name="Course_time_start_lecture"
                    value="<?= $data['Course_time_start_lecture'] ?>">

                <label for="Course_time_end_lecture">เวลาเรียนสิ้นสุด</label>
                <input type="time" id="Course_time_end_lecture" name="Course_time_end_lecture"
                    value="<?= $data['Course_time_end_lecture'] ?>">
            </div>
            
            <div class="form-group">
            <label for="Course_time_start_lab">ปฏิบัติเรียนเริ่มเวลา</label>
                <input type="time" id="Course_time_start_lab" name="Course_time_start_lab"
                    value="<?= $data['Course_time_start_lab'] ?>">

                <label for="Course_time_end_lab">เวลาเรียนสิ้นสุด</label>
                <input type="time" id="Course_time_end_lab" name="Course_time_end_lab"
                    value="<?= $data['Course_time_end_lab'] ?>">

            </div>
            <!--  
<div class="form-group">
                <label for="Credit_total">หน่วยกิตรวม</label>
                <input type="number" id="Credit_total" name="Credit_total" min="0" value="<//?= $data['Credit_total'] ?>"
                    readonly>
                <label>หน่วยกิต</label>
            </div>

            <div class="form-group">
                <label for="Credit_lecture">หน่วยกิตทฤษฎี</label>
                <input type="number" id="Credit_lecture" name="Credit_lecture" min="0"
                    value="<//?= $data['Credit_lecture'] ?>" readonly>
                <label>หน่วยกิต</label>
            <div class="form-group">
                <label for="Credit_lab">หน่วยกิตปฏิบัติ</label>
                <input type="number" id="Credit_lab" name="Credit_lab" min="0" value="<//?= $data['Credit_lab'] ?>"
                    readonly>

                <label>หน่วยกิต</label>

                
            <div class="form-group">
                <label for="Credit_independent">หน่วยกิตศึกษาด้วยตัวเอง</label>
                <input type="number" id="Credit_independent" name="Credit_independent" min="0"
                    value="<//?= $data['Credit_independent'] ?>" readonly>

                <label>หน่วยกิต</label>
            </div>-->

            <div class="form-group">
                <label for="Section">กลุ่มเรียน</label>
                <input type="text" id="Section" name="Section" value="<?= $data['Section'] ?>" placeholder="กลุ่มเรียน"
                    readonly>

                <label for="Student_faculty">คณะ</label>
                <select name="Student_faculty" id="Student_faculty" required>
                    <option value="วิทย์" <?=($data['Student_faculty']=="วิทยาศาสตร์" ) ? 'selected' : '' ?>>วิทยาศาสตร์
                    </option>
                    <option value="วิศวะ" <?=($data['Student_faculty']=="วิศวกรรมศาสตร์" ) ? 'selected' : '' ?>
                        >วิศวกรรมศาสตร์</option>
                    <option value="สถาปัตยกรรมศิลปะและการออกแบบ"
                        <?=($data['Student_faculty']=="สถาปัตยกรรมศิลปะและการออกแบบ" ) ? 'selected' : '' ?>>สถาปัตยกรรม
                        ศิลปะและการออกแบบ</option>
                    <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี"
                        <?=($data['Student_faculty']=="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี" ) ? 'selected' : '' ?>
                        >ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                    <option value="เทคโนโลยีการเกษตร" <?=($data['Student_faculty']=="เทคโนโลยีการเกษตร" ) ? 'selected'
                        : '' ?>>เทคโนโลยีการเกษตร</option>
                    <option value="เทคโนโลยีสารสนเทศ" <?=($data['Student_faculty']=="เทคโนโลยีสารสนเทศ" ) ? 'selected'
                        : '' ?>>เทคโนโลยีสารสนเทศ</option>
                    <option value="อุตสาหกรรมอาหาร" <?=($data['Student_faculty']=="อุตสาหกรรมอาหาร" ) ? 'selected' : ''
                        ?>>อุตสาหกรรมอาหาร</option>
                    <option value="บริหารธุรกิจ" <?=($data['Student_faculty']=="บริหารธุรกิจ" ) ? 'selected' : '' ?>
                        >บริหารธุรกิจ</option>
                    <option value="ศิลปศาสตร์" <?=($data['Student_faculty']=="ศิลปศาสตร์" ) ? 'selected' : '' ?>
                        >ศิลปศาสตร์</option>
                    <option value="แพทยศาสตร์" <?=($data['Student_faculty']=="แพทยศาสตร์" ) ? 'selected' : '' ?>
                        >แพทยศาสตร์</option>
                    <option value="ทันตแพทยศาสตร์" <?=($data['Student_faculty']=="ทันตแพทยศาสตร์" ) ? 'selected' : '' ?>
                        >ทันตแพทยศาสตร์</option>
                    <option value="วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ"
                        <?=($data['Student_faculty']=="วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ" ) ? 'selected' : '' ?>
                        >วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ</option>
                    <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง"
                        <?=($data['Student_faculty']=="วิทยาลัยนวัตกรรมการผลิตขั้นสูง" ) ? 'selected' : '' ?>
                        >วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                    <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ"
                        <?=($data['Student_faculty']=="วิทยาลัยอุตสาหกรรมการบินนานาชาติ" ) ? 'selected' : '' ?>
                        >วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                    <option value="วิทยาลัยวิศวกรรมสังคีต" <?=($data['Student_faculty']=="วิทยาลัยวิศวกรรมสังคีต" )
                        ? 'selected' : '' ?>>วิทยาลัยวิศวกรรมสังคีต</option>
                </select>

                <label for="Student_department">สาขา</label>
                <select name="Student_department" id="Student_department" required>
                    <option value="" disabled selected>-- เลือกสาขา --</option>
                    <?php
                            if (!empty($data['Student_department'])) {
                            echo '<option value="' . $data['Student_department'] . '" selected>' . $data['Student_department'] . '</option>';
                            }
                        ?>
                </select>

                <label for="Student_degree">ชั้นปี</label>
                <select name="Student_degree" id="Student_degree" required>
                    <option value="" disabled selected>-- เลือกชั้นปี --</option>
                    <option value="1" <?=($data['Student_degree']=="1" ) ? 'selected' : '' ?>>1</option>
                    <option value="2" <?=($data['Student_degree']=="2" ) ? 'selected' : '' ?>>2</option>
                    <option value="3" <?=($data['Student_degree']=="3" ) ? 'selected' : '' ?>>3</option>
                    <option value="4" <?=($data['Student_degree']=="4" ) ? 'selected' : '' ?>>4</option>
                    <option value="ปริญญาโท" <?=($data['Student_degree']=="ปริญญาโท" ) ? 'selected' : '' ?>>ปริญญาโท
                    </option>
                    <option value="ปริญญาเอก" <?=($data['Student_degree']=="ปริญญาเอก" ) ? 'selected' : '' ?>>ปริญญาเอก
                    </option>
                </select>
            </div>

            <div class="form-group">

                <label for="Student_enroll">จำนวนนักศึกษาที่ลงทะเบียน</label>
                <input type="text" id="Student_enroll" name="Student_enroll" placeholder="จำนวนนักศึกษาที่ลงทะเบียน"
                    value="<?= $data['Student_enroll'] ?>" required>
                <label for="Student_per_week">จำนวนนักศึกษาต่อสัปดาห์</label>
                <input type="text" id="Student_per_week" name="Student_per_week" placeholder="จำนวนนักศึกษาต่อสัปดาห์"
                    value="<?= $data['Student_per_week'] ?>" required>
            </div>

            <div class="form-group">
                <label>จำนวนชั่วโมงต่อสัปดาห์</label>

                <label>
                    <input type="checkbox" class="course-checkbox" data-input="Hours_per_week_bachelor_degree"
                        <?=isset($data['Hours_per_week_bachelor_degree']) && $data['Hours_per_week_bachelor_degree']> 0
                    ? 'checked' : '' ?>>
                    ปริญญาตรี (ปกติ)
                </label>
                <input type="number" id="Hours_per_week_bachelor_degree" name="Hours_per_week_bachelor_degree" min="0"
                    step="0.5" value="<?= $data['Hours_per_week_bachelor_degree'] ?>"
                    <?=isset($data['Hours_per_week_bachelor_degree']) && $data['Hours_per_week_bachelor_degree']> 0 ? ''
                : 'disabled' ?>
                required> ชั่วโมง/สัปดาห์
                <br>

                <label>
                    <input type="checkbox" class="course-checkbox" data-input="Hours_per_week_inter_bachelor_degree"
                        <?=isset($data['Hours_per_week_inter_bachelor_degree']) &&
                        $data['Hours_per_week_inter_bachelor_degree']> 0 ? 'checked' : '' ?>>
                    ปริญญาตรี (นานาชาติ)
                </label>
                <input type="number" id="Hours_per_week_inter_bachelor_degree"
                    name="Hours_per_week_inter_bachelor_degree" min="0" step="0.5"
                    value="<?= $data['Hours_per_week_inter_bachelor_degree'] ?>"
                    <?=isset($data['Hours_per_week_inter_bachelor_degree']) &&
                    $data['Hours_per_week_inter_bachelor_degree']> 0 ? '' : 'disabled' ?>
                required> ชั่วโมง/สัปดาห์
                <br>

                <label>
                    <input type="checkbox" class="course-checkbox" data-input="Hours_per_week_graduate"
                        <?=isset($data['Hours_per_week_graduate']) && $data['Hours_per_week_graduate']> 0 ? 'checked' :
                    '' ?>>
                    บัณฑิต
                </label>
                <input type="number" id="Hours_per_week_graduate" name="Hours_per_week_graduate" min="0" step="0.5"
                    value="<?= $data['Hours_per_week_graduate'] ?>" <?=isset($data['Hours_per_week_graduate']) &&
                    $data['Hours_per_week_graduate']> 0 ? '' : 'disabled' ?>
                required> ชั่วโมง/สัปดาห์
                <br>
            </div>

            <div class="form-group">
                <label>จำนวนขั่วโมงภาระงานต่อภาคเรียน</label>
                    <input type="number" name="Amount_teach_hours_per_term" min="0" value="<?= $data['Amount_teach_hours_per_term'] ?>" required>
            </div>

            <div class="form-group">
                <label>สัปดาห์ที่สอน</label>
            </div>
            <?php
            // ดึงค่าที่เคยบันทึกจากฐานข้อมูล (เช่น "1,2,3" หรือ "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15")
            $selected_weeks = isset($data['Weeks_selected']) ? explode(',', $data['Weeks_selected']) : [];

            // ตรวจสอบว่ามีครบทั้ง 15 สัปดาห์ไหม
            $allWeeksSelected = count(array_intersect($selected_weeks, range(1, 15))) === 15;
            ?>

            <div class="form-group checkbox-group">
                <label><input type="checkbox" id="all-weeks" <?=$allWeeksSelected ? 'checked' : '' ?>>
                    ทุกสัปดาห์</label>
                <label><input type="checkbox" id="custom-weeks" <?=!$allWeeksSelected && !empty($selected_weeks)
                        ? 'checked' : '' ?>> เลือกเอง</label>
            </div>

            <div class="weeks">
                <div class="checkbox-row">
                    <?php for ($i = 1; $i <= 15; $i++): ?>
                    <div class="checkbox-container">
                        <span>
                            <?= $i ?>
                        </span>
                        <input type="checkbox" class="week-checkbox" name="Course_week[]" value="<?= $i ?>"
                            <?=in_array($i, $selected_weeks) ? 'checked' : '' ?>>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="Workload_for_reimbursement">ภาระงานเพื่อประกอบการเบิก</label>
                <input type="text" name="Workload_for_reimbursement" value="<?= $data['Workload_for_reimbursement'] ?>">
                <label for="remark">หมายเหตุ</label>
                <input type="text" name="remark" value="<?= $data['remark'] ?>">
            </div>


    </div>

    <button type="submit" class="submit-button">บันทึก</button>
    </form>

    </div>


    <script>

        // กำหนดข้อมูลคณะและสาขา
        const departments = {
            วิทย์: ["เทคโนโลยีสิ่งแวดล้อมและการจัดการอย่างยั่งยืน", "เคมีอุตสาหกรรม", "เทคโนโลยีชีวภาพอุตสาหกรรม", "จุลชีววิทยาอุตสาหกรรม",
                "วิทยาการคอมพิวเตอร์", "Math", "ฟิสิกส์อุตสาหกรรม", "สถิติประยุกต์และการวิเคราะห์ข้อมูล", "Kdai", "Industrial and Engineering Chemistry (International Program)",
                "Digital Technology and Integrated Innovation (International Program)"],
            วิศวะ: ["วิศวกรรมระบบไอโอทีและสารสนเทศ", "วิศวกรรมไฟฟ้าสื่อสารและเครือข่าย", "วิศวกรรมไฟฟ้า", "วิศวกรรมอิเล็กทรอนิกส์",
                "วิศวกรรมคอมพิวเตอร์", "วิศวกรรมโยธา", "วิศวกรรมเครื่องกล", "วิศวกรรมขนส่งทางราง", "วิศวกรรมเมคคาทรอนิกส์และออโตเมชัน", "วิศวกรรมเกษตรอัจฉริยะ",
                "วิศวกรรมเคมี", "วิศวกรรมอุตสาหการ", "วิศวกรรมอาหาร", "B.Eng. Biomedical Engineering (Internation Program)",
                "B.Eng. Robotics and AI Engineering (Internation Program)", "B. Eng. Financial Enineering (International Program)",
                "B.Eng. Software Engineering (International Program)", "B.Eng. Civil Engineering (International Program)",
                "B.Eng. Mechanical Engineering (International Program)", "B.Eng. Chemical Engineering (International Program)",
                "B.Eng. Industrial Engineering and Logistics Management (International Program)", "B.Eng. Engineering Management and Entrepreneurship (Internation Program)",
                "B.Eng. Electrical Engineering (Internation Program)", "B.Eng. Energy Engineering (Internation Program)",
                "B.Eng. Computer Engineering (International Program)", "วิศวกรรมคอมพิวเตอร์ (ต่อเนื่อง)", "วิศวกรรมการวัดคุม (ต่อเนื่อง)",
                "วิศวกรรมโยธา (ต่อเนื่อง)", "วิศวกรรมระบบอุตสาหกรรมการเกษตร (ต่อเนื่อง)"],
            สถาปัตยกรรมศิลปะและการออกแบบ: ["สถาปัตยกรรมหลัก", "ภูมิสถาปัตยกรรม", "สถาปัตยกรรมภายใน", "ศิลปอุตสาหกรรม", "สาขาวิชาการออกแบบประสบการณ์สำหรับสื่อบูรณาการ",
                "การถ่ายภาพ", "นิเทศศิลป์", "ภาพยนตร์และดิจิทัล มีเดีย", "สาขาวิชาศิลปกรรม มีเดียอาร์ต และอิลลัสเตชั่นอาร์ต", "สาขาวิชาสถาปัตยกรรม (หลักสูตรนานาชาติ)",
                "สาขาวิชาศิลปะสร้างสรรค์และภัณฑารักษ์ศึกษา (หลักสูตรนานาชาติ)", "หลักสูตรควบระดับปริญญาตรี 2 ปริญญา วิทยาศาสตรบัณฑิต สาขาวิชาสถาปัตยกรรม (หลักสูตรนานาชาติ) วิศวกรรมศาสตรบัณฑิต และสาขาวิชาวิศวกรรมโยธา (หลักสูตรนานาชาติ)",
                "หลักสูตรควบระดับปริญญาตรี 2 ปริญญา วิทยาศาสตรบัณฑิต สาขาวิชาสถาปัตยกรรม (หลักสูตรนานาชาติ) วิศวกรรมศาสตรบัณฑิต และสาขาวิชาวิศวกรรมโยธา (หลักสูตรนานาชาติ)"],
            ครุศาสตร์อุตสาหกรรมและเทคโนโลยี: ["สถาปัตยกรรม (5 ปี)", "ครุศาสตร์การออกแบบสภาพแวดล้อมภายใน (5 ปี)", "ครุศาสตร์การออกแบบ",
                "ครุศาสตร์วิศวกรรม (4 ปี)", "สาขาวิชาเทคโนโลยีอิเล็กทรอนิกส์", "ครุศาสตร์เกษตร (4 ปี)", "บูรณาการนวัตกรรมเพื่อสินค้าและบริการ (ต่อเนื่อง 2 ปี)"],
            เทคโนโลยีการเกษตร: ["เศรษฐศาสตร์และธุรกิจเพื่อพัฒนาการเกษตร", "โครงการหลักสูตรควบระดับปริญญาตรี 2 ปริญญา AGRINOVATOR",
                "นวัตกรรมการผลิตสัตว์น้ำและการจัดการทรัพยากรประมง", "การจัดการสมาร์ตฟาร์ม", "การออกแบบและการจัดการภูมิทัศน์เพื่อสิ่งแวดล้อม", "เทคโนโลยีการผลิตพืช",
                "เทคโนโลยีการผลิตสัตว์และวิทยาศาสตร์เนื้อสัตว์", "พัฒนาการเกษตร", "นิเทศศาสตร์เกษตร"],
            เทคโนโลยีสารสนเทศ: ["เทคโนโลยีสารสนเทศ", "วิทยาการข้อมูลและการวิเคราะห์เชิงธุรกิจ", "Business Information Technology", "เทคโนโลยีปัญญาประดิษฐ์"],
            อุตสาหกรรมอาหาร: ["เทคโนโลยีการหมักในอุตสาหกรรมอาหาร", "วิทยาศาสตร์และเทคโนโลยีการอาหาร", "วิศวกรรมแปรรูปอาหาร",
                "วิศวกรรมแปรรูปอาหาร โครงการหลักสูตรควบระดับปริญญาตรี 2 ปริญญา", "Culinary Science and Foodservice Management (International program)"],
            วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ: ["วิศวกรรมวัสดุนาโน", "Dual Bachelor’s Degree Program consists of Bachelor of Engineering (Smart Materials Technology) and Bachelor of Engineering (Robotics and AI Engineering)"],
            วิทยาลัยนวัตกรรมการผลิตขั้นสูง: ["วิศวกรรมระบบการผลิต", "วิศวกรรมระบบการผลิต (ต่อเนื่อง) (โครงการอาชีวะพรีเมียม)"],
            บริหารธุรกิจ: ["บริหารธุรกิจบัณฑิต", "เศรษฐศาสตร์ธุรกิจและการจัดการ", "BACHELOR OF BUSINESS ADMINISTRATION (INTERNATIONAL PROGRAM)",
                "Bachelor of Business Administration Program in Global Entrepreneurship (International Program)"],
            วิทยาลัยอุตสาหกรรมการบินนานาชาติ: ["วิศวกรรมการบินและอวกาศ (นานาชาติ)", "วิศวกรรมการบินและนักบินพาณิชย์ (นานาชาติ)", "การจัดการโลจิสติกส์ (นานาชาติ)"],
            ศิลปศาสตร์: ["ภาษาอังกฤษ", "ภาษาญี่ปุ่นธุรกิจ", "นวัตกรรมการท่องเที่ยวและการบริการ", "ภาษาจีนเพื่ออุตสาหกรรม"],
            แพทยศาสตร์: ["แพทยศาสตรบัณฑิต (นานาชาติ)"],
            วิทยาลัยวิศวกรรมสังคีต: ["วิศวกรรมดนตรีและสื่อประสม"],
            ทันตแพทยศาสตร์: ["Doctor of Dental Surgery"]
        };
        const facultySelect = document.getElementById("Student_faculty");
        const departmentSelect = document.getElementById("Student_department");
        //const submitBtn = document.getElementById("submitBtn");


        facultySelect.addEventListener("change", function () {
            const selectedFaculty = this.value;
            departmentSelect.innerHTML = '<option value="">-- เลือกสาขา --</option>'; // รีเซ็ต dropdown สาขา

            if (selectedFaculty) {
                departments[selectedFaculty].forEach(dep => {
                    const option = document.createElement("option");
                    option.value = dep;
                    option.textContent = dep;
                    departmentSelect.appendChild(option);
                });
                departmentSelect.disabled = false;
            } else {
                departmentSelect.disabled = true;
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const checkboxes = document.querySelectorAll(".course-checkbox");

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function () {
                    checkboxes.forEach(cb => {
                        if (cb !== this) {
                            cb.checked = false;
                            const inputField = document.getElementById(cb.getAttribute("data-input"));
                            inputField.disabled = true;
                            inputField.value = ""; // ลบค่าที่เคยกรอก
                        }
                    });

                    const inputId = this.getAttribute("data-input");
                    document.getElementById(inputId).disabled = !this.checked;
                });
            });

            // ฟอร์มส่งข้อมูล
            const form = document.querySelector("form");
            form.addEventListener("submit", function (event) {
                event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

                const formData = new FormData(this);

                fetch("Add_data.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.text())
                    .catch(error => console.error("Error:", error));
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            const allWeeksCheckbox = document.getElementById('all-weeks');
            const customWeeksCheckbox = document.getElementById('custom-weeks');
            const weekCheckboxes = document.querySelectorAll('.week-checkbox');

            function resetCheckboxes() {
                weekCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    checkbox.disabled = false;
                });
            }

            allWeeksCheckbox.addEventListener('change', () => {
                if (allWeeksCheckbox.checked) {
                    customWeeksCheckbox.checked = false; // ปิด "เลือกเอง"
                    weekCheckboxes.forEach(checkbox => {
                        checkbox.checked = true;

                    });
                } else if (!customWeeksCheckbox.checked) {
                    resetCheckboxes(); // รีเซ็ต checkbox ทั้งหมด
                }
            });

            customWeeksCheckbox.addEventListener('change', () => {
                if (customWeeksCheckbox.checked) {
                    allWeeksCheckbox.checked = false; // ปิด "ทุกสัปดาห์"
                    resetCheckboxes(); // รีเซ็ต checkbox ทั้งหมด
                } else if (!allWeeksCheckbox.checked) {
                    resetCheckboxes(); // รีเซ็ต checkbox ทั้งหมด
                }
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("details");

            form.addEventListener("submit", function (event) {
                event.preventDefault(); // ป้องกัน Form Submit ปกติ

                const formData = new FormData(form);

                fetch("Add_data.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert(data.message); // Popup เดียว
                            window.location.href = data.redirect; // Redirect
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });


    </script>

</body>

</html>