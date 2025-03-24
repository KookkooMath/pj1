<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลรายวิชาสอน</title>
    <link rel="icon" href="img/โลโก้.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Add_teaching.css">
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
    $course_day = isset($_GET['Course_day']) ? $_GET['Course_day'] : '';
    ?>

    <div class="main-container">
        <div class="form-container">
            <h2>เพิ่มข้อมูลรายวิชาสอน วัน <?= $course_day ?> ปีการศึกษา <?= $year ?> ภาคเรียนที่ <?= $term ?></h2>

            <form id="courseForm" action="Add_data.php" method="POST">
                <input type="hidden" name="Year" value="<?= $year ?>">
                <input type="hidden" name="Term" value="<?= $term ?>">
                <input type="hidden" name="Course_day" value="<?= $course_day ?>">

                <div class="form-section">
                    <h3>ข้อมูลรายวิชา</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="CourseID">รหัสวิชา</label>
                            <input type="text" name="CourseID" id="CourseID" placeholder="รหัสวิชา" required>
                        </div>
                        <div class="search-button-container">
                            <button type="button" class="search-button" onclick="searchCourse()">ค้นหา</button>
                        </div>
                        <div class="form-group">
                            <label for="Course_name">ชื่อวิชา</label>
                            <input type="text" id="Course_name" name="Course_name" placeholder="ชื่อวิชา" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Credit_combined">หน่วยกิต</label>
                            <input type="text" id="Credit_combined" name="Credit_combined" readonly>
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
                                    <input type="time" id="Course_time_start_lecture" name="Course_time_start_lecture" placeholder="00:00">
                                </div>
                                <div class="form-group">
                                    <label for="Course_time_end_lecture">สิ้นสุดเวลา</label>
                                    <input type="time" id="Course_time_end_lecture" name="Course_time_end_lecture" placeholder="00:00">
                                </div>
                            </div>
                        </div>
                        <div class="time-group">
                            <h4>ปฏิบัติ</h4>
                            <div class="time-inputs">
                                <div class="form-group">
                                    <label for="Course_time_start_lab">เริ่มเวลา</label>
                                    <input type="time" id="Course_time_start_lab" name="Course_time_start_lab">
                                </div>
                                <div class="form-group">
                                    <label for="Course_time_end_lab">สิ้นสุดเวลา</label>
                                    <input type="time" id="Course_time_end_lab" name="Course_time_end_lab">
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
                            <input type="text" id="Section" name="Section" placeholder="กลุ่มเรียน" required>
                        </div>
                        <div class="form-group">
                            <label for="Student_faculty">คณะ</label>
                            <select name="Student_faculty" id="Student_faculty" required>
                                <option value="" disabled selected>-- เลือกคณะ --</option>
                                <option value="วิทยาศาสตร์">วิทยาศาสตร์</option>
                                <option value="วิศวกรรมศาสตร์">วิศวกรรมศาสตร์</option>
                                <option value="สถาปัตยกรรมศิลปะและการออกแบบ">สถาปัตยกรรม ศิลปะและการออกแบบ</option>
                                <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี">ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                                <option value="เทคโนโลยีการเกษตร">เทคโนโลยีการเกษตร</option>
                                <option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>
                                <option value="อุตสาหกรรมอาหาร">อุตสาหกรรมอาหาร</option>
                                <option value="บริหารธุรกิจ">บริหารธุรกิจ</option>
                                <option value="ศิลปศาสตร์">ศิลปศาสตร์</option>
                                <option value="แพทยศาสตร์">แพทยศาสตร์</option>
                                <option value="ทันตแพทยศาสตร์">ทันตแพทยศาสตร์</option>
                                <option value="วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ">วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ</option>
                                <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง">วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                                <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ">วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                                <option value="วิทยาลัยวิศวกรรมสังคีต">วิทยาลัยวิศวกรรมสังคีต</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Student_department">สาขา</label>
                            <select name="Student_department" id="Student_department" disabled required>
                                <option value="" disabled selected>-- เลือกสาขา --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Student_degree">ชั้นปี</label>
                            <select name="Student_degree" id="Student_degree" required>
                                <option value="" disabled selected>-- เลือกชั้นปี --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="ปริญญาโท">ปริญญาโท</option>
                                <option value="ปริญญาเอก">ปริญญาเอก</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="Student_enroll">จำนวนนักศึกษาที่ลงทะเบียน</label>
                            <input type="number" id="Student_enroll" name="Student_enroll" placeholder="จำนวนนักศึกษาที่ลงทะเบียน" required>
                        </div>
                        <div class="form-group">
                            <label for="Student_per_week">จำนวนนักศึกษาต่อสัปดาห์</label>
                            <input type="number" id="Student_per_week" name="Student_per_week" placeholder="จำนวนนักศึกษาต่อสัปดาห์" required>
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
                    <div class="weeks-selection">
                        <div class="week-options">
                            <div class="option">
                                <input type="checkbox" id="all-weeks">
                                <label for="all-weeks">ทุกสัปดาห์</label>
                            </div>
                            <div class="option">
                                <input type="checkbox" id="custom-weeks">
                                <label for="custom-weeks">เลือกเอง</label>
                            </div>
                        </div>
                        <div class="weeks-container">
                            <div class="checkbox-row">
                                <?php for ($i = 1; $i <= 15; $i++): ?>
                                    <div class="week-item">
                                        <input type="checkbox" id="week-<?= $i ?>" class="week-checkbox" name="Course_week[]" value="<?= $i ?>">
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
                            <input type="text" id="Workload_for_reimbursement" name="Workload_for_reimbursement">
                        </div>
                        <div class="form-group">
                            <label for="remark">หมายเหตุ</label>
                            <input type="text" id="remark" name="remark">
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
    <script src="js/Add_teaching.js"></script>
</body>

</html>