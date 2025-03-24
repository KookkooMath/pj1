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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Update_teach.css">
</head>

<body>
    <div class="top-bar">
        <a href="TeachingInformation.php" class="back-link">
            <span class="back-icon">
                <img src="img/angle-left.png" alt="Back">
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

    // เตรียมข้อมูลเริ่มต้น
    $data = [
        'CourseID' => '',
        'Course_name' => '',
        'Credit_total' => '',
        'Credit_lecture' => '',
        'Credit_lab' => '',
        'Credit_independent' => '',
        'Course_time_start_lecture' => '',
        'Course_time_end_lecture' => '',
        'Course_time_start_lab' => '',
        'Course_time_end_lab' => '',
        'Section' => '',
        'Student_faculty' => '',
        'Student_department' => '',
        'Student_degree' => '',
        'Student_enroll' => '',
        'Student_per_week' => '',
        'Hours_per_week_bachelor_degree' => 0,
        'Hours_per_week_inter_bachelor_degree' => 0,
        'Hours_per_week_graduate' => 0,
        'Amount_teach_hours_per_term' => '',
        'Weeks_selected' => '',
        'Workload_for_reimbursement' => '',
        'remark' => ''
    ];

    $Credit_combined = '';

    // ใช้ JOIN เพื่อดึงข้อมูลจากทั้งตาราง teach และ courses
    if (!empty($year) && !empty($term) && !empty($courseID) && !empty($course_day) && !empty($section)) {
        $stmt = $conn->prepare("SELECT teach.*, courses.Course_name, courses.Credit_total, courses.Credit_lecture, courses.Credit_lab, courses.Credit_independent 
                FROM teach 
                INNER JOIN courses ON teach.CourseID = courses.CourseID
                WHERE teach.Year = ? AND teach.Term = ? AND teach.CourseID = ? AND teach.Course_day = ? AND teach.Section = ?");
        $stmt->bind_param("iissi", $year, $term, $courseID, $course_day, $section);
        $stmt->execute();
        $result = $stmt->get_result();

        // ตรวจสอบว่ามีข้อมูลที่ดึงมา
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // อัพเดทค่าในตัวแปร $data
            foreach ($row as $key => $value) {
                $data[$key] = $value;
            }

            // คำนวณ Credit_combined
            if (isset($data['Credit_total'], $data['Credit_lecture'], $data['Credit_lab'], $data['Credit_independent'])) {
                $Credit_combined = "{$data['Credit_total']}({$data['Credit_lecture']}-{$data['Credit_lab']}-{$data['Credit_independent']})";
            } else {
                $Credit_combined = 'ข้อมูลไม่ครบถ้วน';
            }
        }

        $stmt->close();
    }

    $conn->close();

    $data['Hours_per_week_bachelor_degree'] = isset($data['Hours_per_week_bachelor_degree']) ? $data['Hours_per_week_bachelor_degree'] : 0;
    $data['Hours_per_week_inter_bachelor_degree'] = isset($data['Hours_per_week_inter_bachelor_degree']) ? $data['Hours_per_week_inter_bachelor_degree'] : 0;
    $data['Hours_per_week_graduate'] = isset($data['Hours_per_week_graduate']) ? $data['Hours_per_week_graduate'] : 0;
    ?>

    <div class="main-container">
        <div class="form-container">
            <h2>แก้ไขข้อมูลรายวิชา วัน <?= $course_day ?> ปีการศึกษา <?= $year ?> ภาคเรียนที่ <?= $term ?></h2>

            <form id="courseForm" action="Add_data.php" method="POST">
                <input type="hidden" name="Year" value="<?= $year ?>">
                <input type="hidden" name="Term" value="<?= $term ?>">
                <input type="hidden" name="Course_day" value="<?= $course_day ?>">

                <div class="form-section">
                    <h3>ข้อมูลรายวิชา</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="CourseID">รหัสวิชา</label>
                            <input type="text" name="CourseID" id="CourseID" value="<?= htmlspecialchars($data['CourseID']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Course_name">ชื่อวิชา</label>
                            <input type="text" id="Course_name" name="Course_name" value="<?= htmlspecialchars($data['Course_name']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Credit_combined">หน่วยกิต</label>
                            <input type="text" id="Credit_combined" name="Credit_combined" value="<?= htmlspecialchars($Credit_combined) ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>เวลาเรียน</h3>
                    <div class="form-row">
                        <div class="time-group">
                            <h4>ทฤษฎี</h4>
                            <div class="time-inputs">
                                <div class="form-group">
                                    <label for="Course_time_start_lecture">เริ่มเวลา</label>
                                    <input type="time" id="Course_time_start_lecture" name="Course_time_start_lecture"
                                        value="<?= !empty($data['Course_time_start_lecture']) ? htmlspecialchars($data['Course_time_start_lecture']) : '' ?>"
                                        placeholder="00:00">
                                </div>
                                <div class="form-group">
                                    <label for="Course_time_end_lecture">สิ้นสุดเวลา</label>
                                    <input type="time" id="Course_time_end_lecture" name="Course_time_end_lecture"
                                        value="<?= !empty($data['Course_time_end_lecture']) ? htmlspecialchars($data['Course_time_end_lecture']) : '' ?>"
                                        placeholder="00:00">
                                </div>
                            </div>
                        </div>
                        <div class="time-group">
                            <h4>ปฏิบัติ</h4>
                            <div class="time-inputs">
                                <div class="form-group">
                                    <label for="Course_time_start_lab">เริ่มเวลา</label>
                                    <input type="time" id="Course_time_start_lab" name="Course_time_start_lab" value="<?= htmlspecialchars($data['Course_time_start_lab']) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Course_time_end_lab">สิ้นสุดเวลา</label>
                                    <input type="time" id="Course_time_end_lab" name="Course_time_end_lab" value="<?= htmlspecialchars($data['Course_time_end_lab']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>ข้อมูลการเรียน</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Section">กลุ่มเรียน</label>
                            <input type="text" id="Section" name="Section" value="<?= htmlspecialchars($data['Section']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Student_faculty">คณะ</label>
                            <select name="Student_faculty" id="Student_faculty" required>
                                <option value="วิทย์" <?= ($data['Student_faculty'] == "วิทยาศาสตร์") ? 'selected' : '' ?>>วิทยาศาสตร์</option>
                                <option value="วิศวะ" <?= ($data['Student_faculty'] == "วิศวกรรมศาสตร์") ? 'selected' : '' ?>>วิศวกรรมศาสตร์</option>
                                <option value="สถาปัตยกรรมศิลปะและการออกแบบ" <?= ($data['Student_faculty'] == "สถาปัตยกรรมศิลปะและการออกแบบ") ? 'selected' : '' ?>>สถาปัตยกรรม ศิลปะและการออกแบบ</option>
                                <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี" <?= ($data['Student_faculty'] == "ครุศาสตร์อุตสาหกรรมและเทคโนโลยี") ? 'selected' : '' ?>>ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                                <option value="เทคโนโลยีการเกษตร" <?= ($data['Student_faculty'] == "เทคโนโลยีการเกษตร") ? 'selected' : '' ?>>เทคโนโลยีการเกษตร</option>
                                <option value="เทคโนโลยีสารสนเทศ" <?= ($data['Student_faculty'] == "เทคโนโลยีสารสนเทศ") ? 'selected' : '' ?>>เทคโนโลยีสารสนเทศ</option>
                                <option value="อุตสาหกรรมอาหาร" <?= ($data['Student_faculty'] == "อุตสาหกรรมอาหาร") ? 'selected' : '' ?>>อุตสาหกรรมอาหาร</option>
                                <option value="บริหารธุรกิจ" <?= ($data['Student_faculty'] == "บริหารธุรกิจ") ? 'selected' : '' ?>>บริหารธุรกิจ</option>
                                <option value="ศิลปศาสตร์" <?= ($data['Student_faculty'] == "ศิลปศาสตร์") ? 'selected' : '' ?>>ศิลปศาสตร์</option>
                                <option value="แพทยศาสตร์" <?= ($data['Student_faculty'] == "แพทยศาสตร์") ? 'selected' : '' ?>>แพทยศาสตร์</option>
                                <option value="ทันตแพทยศาสตร์" <?= ($data['Student_faculty'] == "ทันตแพทยศาสตร์") ? 'selected' : '' ?>>ทันตแพทยศาสตร์</option>
                                <option value="วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ" <?= ($data['Student_faculty'] == "วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ") ? 'selected' : '' ?>>วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ</option>
                                <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง" <?= ($data['Student_faculty'] == "วิทยาลัยนวัตกรรมการผลิตขั้นสูง") ? 'selected' : '' ?>>วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                                <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ" <?= ($data['Student_faculty'] == "วิทยาลัยอุตสาหกรรมการบินนานาชาติ") ? 'selected' : '' ?>>วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                                <option value="วิทยาลัยวิศวกรรมสังคีต" <?= ($data['Student_faculty'] == "วิทยาลัยวิศวกรรมสังคีต") ? 'selected' : '' ?>>วิทยาลัยวิศวกรรมสังคีต</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="Student_department">สาขา</label>
                            <select name="Student_department" id="Student_department" required>
                                <option value="" disabled selected>-- เลือกสาขา --</option>
                                <?php
                                if (!empty($data['Student_department'])) {
                                    echo '<option value="' . htmlspecialchars($data['Student_department']) . '" selected>' . htmlspecialchars($data['Student_department']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Student_degree">ชั้นปี</label>
                            <select name="Student_degree" id="Student_degree" required>
                                <option value="" disabled selected>-- เลือกชั้นปี --</option>
                                <option value="1" <?= ($data['Student_degree'] == "1") ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= ($data['Student_degree'] == "2") ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= ($data['Student_degree'] == "3") ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= ($data['Student_degree'] == "4") ? 'selected' : '' ?>>4</option>
                                <option value="ปริญญาโท" <?= ($data['Student_degree'] == "ปริญญาโท") ? 'selected' : '' ?>>ปริญญาโท</option>
                                <option value="ปริญญาเอก" <?= ($data['Student_degree'] == "ปริญญาเอก") ? 'selected' : '' ?>>ปริญญาเอก</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="Student_enroll">จำนวนนักศึกษาที่ลงทะเบียน</label>
                            <input type="number" id="Student_enroll" name="Student_enroll" value="<?= htmlspecialchars($data['Student_enroll']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Student_per_week">จำนวนนักศึกษาต่อสัปดาห์</label>
                            <input type="number" id="Student_per_week" name="Student_per_week" value="<?= htmlspecialchars($data['Student_per_week']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>จำนวนชั่วโมงต่อสัปดาห์</h3>
                    <div class="hours-container">
                        <div class="hour-group-row">
                            <div class="hour-group">
                                <div class="checkbox-input">
                                    <input type="checkbox" id="bachelor_checkbox" class="course-checkbox" data-input="Hours_per_week_bachelor_degree">
                                    <label for="bachelor_checkbox">ปริญญาตรี (ปกติ)</label>
                                </div>
                                <div class="hours-input">
                                    <input type="number" id="Hours_per_week_bachelor_degree" name="Hours_per_week_bachelor_degree" min="0" step="0.5" disabled required>
                                    <span>ชั่วโมง/สัปดาห์</span>
                                </div>
                            </div>
                            <div class="hour-group">
                                <div class="checkbox-input">
                                    <input type="checkbox" id="inter_bachelor_checkbox" class="course-checkbox" data-input="Hours_per_week_inter_bachelor_degree">
                                    <label for="inter_bachelor_checkbox">ปริญญาตรี (นานาชาติ)</label>
                                </div>
                                <div class="hours-input">
                                    <input type="number" id="Hours_per_week_inter_bachelor_degree" name="Hours_per_week_inter_bachelor_degree" min="0" step="0.5" disabled required>
                                    <span>ชั่วโมง/สัปดาห์</span>
                                </div>
                            </div>
                            <div class="hour-group">
                                <div class="checkbox-input">
                                    <input type="checkbox" id="graduate_checkbox" class="course-checkbox" data-input="Hours_per_week_graduate">
                                    <label for="graduate_checkbox">บัณฑิต</label>
                                </div>
                                <div class="hours-input">
                                    <input type="number" id="Hours_per_week_graduate" name="Hours_per_week_graduate" min="0" step="0.5" disabled required>
                                    <span>ชั่วโมง/สัปดาห์</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Amount_teach_hours_per_term">จำนวนชั่วโมงภาระงานต่อภาคเรียน</label>
                            <input type="number" id="Amount_teach_hours_per_term" name="Amount_teach_hours_per_term" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>สัปดาห์ที่สอน</h3>
                    <?php
                    // ดึงค่าที่เคยบันทึกจากฐานข้อมูล
                    $selected_weeks = isset($data['Weeks_selected']) ? explode(',', $data['Weeks_selected']) : [];

                    // ตรวจสอบว่ามีครบทั้ง 15 สัปดาห์ไหม
                    $allWeeksSelected = count(array_intersect($selected_weeks, range(1, 15))) === 15;
                    ?>

                    <div class="weeks-selection">
                        <div class="week-options">
                            <div class="option">
                                <input type="checkbox" id="all-weeks" <?= $allWeeksSelected ? 'checked' : '' ?>>
                                <label for="all-weeks">ทุกสัปดาห์</label>
                            </div>
                            <div class="option">
                                <input type="checkbox" id="custom-weeks" <?= !$allWeeksSelected && !empty($selected_weeks) ? 'checked' : '' ?>>
                                <label for="custom-weeks">เลือกเอง</label>
                            </div>
                        </div>

                        <div class="weeks-container">
                            <div class="checkbox-row">
                                <?php for ($i = 1; $i <= 15; $i++): ?>
                                    <div class="week-item">
                                        <input type="checkbox" id="week-<?= $i ?>" class="week-checkbox" name="Course_week[]" value="<?= $i ?>" <?= in_array($i, $selected_weeks) ? 'checked' : '' ?>>
                                        <span class="week-number"><?= $i ?></span>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>ข้อมูลเพิ่มเติม</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Workload_for_reimbursement">ภาระงานเพื่อประกอบการเบิก</label>
                            <input type="text" id="Workload_for_reimbursement" name="Workload_for_reimbursement" value="<?= htmlspecialchars($data['Workload_for_reimbursement']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="remark">หมายเหตุ</label>
                            <input type="text" id="remark" name="remark" value="<?= htmlspecialchars($data['remark']) ?>">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-button">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/Update_teach.js"></script>
</body>

</html>