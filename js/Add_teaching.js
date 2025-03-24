// กำหนดข้อมูลคณะและสาขา
const departments = {
  วิทยาศาสตร์: [
    "เทคโนโลยีสิ่งแวดล้อมและการจัดการอย่างยั่งยืน",
    "เคมีอุตสาหกรรม",
    "เทคโนโลยีชีวภาพอุตสาหกรรม",
    "จุลชีววิทยาอุตสาหกรรม",
    "วิทยาการคอมพิวเตอร์",
    "Math",
    "ฟิสิกส์อุตสาหกรรม",
    "สถิติประยุกต์และการวิเคราะห์ข้อมูล",
    "Kdai",
    "Industrial and Engineering Chemistry (International Program)",
    "Digital Technology and Integrated Innovation (International Program)",
  ],
  วิศวกรรมศาสตร์: [
    "วิศวกรรมระบบไอโอทีและสารสนเทศ",
    "วิศวกรรมไฟฟ้าสื่อสารและเครือข่าย",
    "วิศวกรรมไฟฟ้า",
    "วิศวกรรมอิเล็กทรอนิกส์",
    "วิศวกรรมคอมพิวเตอร์",
    "วิศวกรรมโยธา",
    "วิศวกรรมเครื่องกล",
    "วิศวกรรมขนส่งทางราง",
    "วิศวกรรมเมคคาทรอนิกส์และออโตเมชัน",
    "วิศวกรรมเกษตรอัจฉริยะ",
    "วิศวกรรมเคมี",
    "วิศวกรรมอุตสาหการ",
    "วิศวกรรมอาหาร",
    "B.Eng. Biomedical Engineering (International Program)",
    "B.Eng. Robotics and AI Engineering (International Program)",
    "B.Eng. Financial Engineering (International Program)",
    "B.Eng. Software Engineering (International Program)",
    "B.Eng. Civil Engineering (International Program)",
    "B.Eng. Mechanical Engineering (International Program)",
    "B.Eng. Chemical Engineering (International Program)",
    "B.Eng. Industrial Engineering and Logistics Management (International Program)",
    "B.Eng. Engineering Management and Entrepreneurship (International Program)",
    "B.Eng. Electrical Engineering (International Program)",
    "B.Eng. Energy Engineering (International Program)",
    "B.Eng. Computer Engineering (International Program)",
    "วิศวกรรมคอมพิวเตอร์ (ต่อเนื่อง)",
    "วิศวกรรมการวัดคุม (ต่อเนื่อง)",
    "วิศวกรรมโยธา (ต่อเนื่อง)",
    "วิศวกรรมระบบอุตสาหกรรมการเกษตร (ต่อเนื่อง)",
  ],
  สถาปัตยกรรมศิลปะและการออกแบบ: [
    "สถาปัตยกรรมหลัก",
    "ภูมิสถาปัตยกรรม",
    "สถาปัตยกรรมภายใน",
    "ศิลปอุตสาหกรรม",
    "สาขาวิชาการออกแบบประสบการณ์สำหรับสื่อบูรณาการ",
    "การถ่ายภาพ",
    "นิเทศศิลป์",
    "ภาพยนตร์และดิจิทัล มีเดีย",
    "สาขาวิชาศิลปกรรม มีเดียอาร์ต และอิลลัสเตชั่นอาร์ต",
    "สาขาวิชาสถาปัตยกรรม (หลักสูตรนานาชาติ)",
    "สาขาวิชาศิลปะสร้างสรรค์และภัณฑารักษ์ศึกษา (หลักสูตรนานาชาติ)",
    "หลักสูตรควบระดับปริญญาตรี 2 ปริญญา วิทยาศาสตรบัณฑิต สาขาวิชาสถาปัตยกรรม (หลักสูตรนานาชาติ) วิศวกรรมศาสตรบัณฑิต และสาขาวิชาวิศวกรรมโยธา (หลักสูตรนานาชาติ)",
  ],
  ครุศาสตร์อุตสาหกรรมและเทคโนโลยี: [
    "สถาปัตยกรรม (5 ปี)",
    "ครุศาสตร์การออกแบบสภาพแวดล้อมภายใน (5 ปี)",
    "ครุศาสตร์การออกแบบ",
    "ครุศาสตร์วิศวกรรม (4 ปี)",
    "สาขาวิชาเทคโนโลยีอิเล็กทรอนิกส์",
    "ครุศาสตร์เกษตร (4 ปี)",
    "บูรณาการนวัตกรรมเพื่อสินค้าและบริการ (ต่อเนื่อง 2 ปี)",
  ],
  เทคโนโลยีการเกษตร: [
    "เศรษฐศาสตร์และธุรกิจเพื่อพัฒนาการเกษตร",
    "โครงการหลักสูตรควบระดับปริญญาตรี 2 ปริญญา AGRINOVATOR",
    "นวัตกรรมการผลิตสัตว์น้ำและการจัดการทรัพยากรประมง",
    "การจัดการสมาร์ตฟาร์ม",
    "การออกแบบและการจัดการภูมิทัศน์เพื่อสิ่งแวดล้อม",
    "เทคโนโลยีการผลิตพืช",
    "เทคโนโลยีการผลิตสัตว์และวิทยาศาสตร์เนื้อสัตว์",
    "พัฒนาการเกษตร",
    "นิเทศศาสตร์เกษตร",
  ],
  เทคโนโลยีสารสนเทศ: [
    "เทคโนโลยีสารสนเทศ",
    "วิทยาการข้อมูลและการวิเคราะห์เชิงธุรกิจ",
    "Business Information Technology",
    "เทคโนโลยีปัญญาประดิษฐ์",
  ],
  อุตสาหกรรมอาหาร: [
    "เทคโนโลยีการหมักในอุตสาหกรรมอาหาร",
    "วิทยาศาสตร์และเทคโนโลยีการอาหาร",
    "วิศวกรรมแปรรูปอาหาร",
    "วิศวกรรมแปรรูปอาหาร โครงการหลักสูตรควบระดับปริญญาตรี 2 ปริญญา",
    "Culinary Science and Foodservice Management (International program)",
  ],
  วิทยาลัยเทคโนโลยีและนวัตกรรมวัสดุ: [
    "วิศวกรรมวัสดุนาโน",
    "Dual Bachelor’s Degree Program consists of Bachelor of Engineering (Smart Materials Technology) and Bachelor of Engineering (Robotics and AI Engineering)",
  ],
  วิทยาลัยนวัตกรรมการผลิตขั้นสูง: [
    "วิศวกรรมระบบการผลิต",
    "วิศวกรรมระบบการผลิต (ต่อเนื่อง) (โครงการอาชีวะพรีเมียม)",
  ],
  บริหารธุรกิจ: [
    "บริหารธุรกิจบัณฑิต",
    "เศรษฐศาสตร์ธุรกิจและการจัดการ",
    "BACHELOR OF BUSINESS ADMINISTRATION (INTERNATIONAL PROGRAM)",
    "Bachelor of Business Administration Program in Global Entrepreneurship (International Program)",
  ],
  วิทยาลัยอุตสาหกรรมการบินนานาชาติ: [
    "วิศวกรรมการบินและอวกาศ (นานาชาติ)",
    "วิศวกรรมการบินและนักบินพาณิชย์ (นานาชาติ)",
    "การจัดการโลจิสติกส์ (นานาชาติ)",
  ],
  ศิลปศาสตร์: [
    "ภาษาอังกฤษ",
    "ภาษาญี่ปุ่นธุรกิจ",
    "นวัตกรรมการท่องเที่ยวและการบริการ",
    "ภาษาจีนเพื่ออุตสาหกรรม",
  ],
  แพทยศาสตร์: ["แพทยศาสตรบัณฑิต (นานาชาติ)"],
  วิทยาลัยวิศวกรรมสังคีต: ["วิศวกรรมดนตรีและสื่อประสม"],
  ทันตแพทยศาสตร์: ["Doctor of Dental Surgery"],
};

// เมื่อโหลดหน้าเว็บ
document.addEventListener("DOMContentLoaded", function () {
  const facultySelect = document.getElementById("Student_faculty");
  const departmentSelect = document.getElementById("Student_department");
  const checkboxes = document.querySelectorAll(".course-checkbox");
  const weekItems = document.querySelectorAll(".week-item");
  const allWeeksCheckbox = document.getElementById("all-weeks");
  const customWeeksCheckbox = document.getElementById("custom-weeks");
  const form = document.querySelector("form");

  // การจัดการ dropdown คณะและสาขา
  facultySelect.addEventListener("change", function () {
    const selectedFaculty = this.value;
    departmentSelect.innerHTML =
      '<option value="" disabled selected>-- เลือกสาขา --</option>';

    if (selectedFaculty && departments[selectedFaculty]) {
      departments[selectedFaculty].forEach((dep) => {
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

  // การจัดการ checkbox ชั่วโมงต่อสัปดาห์
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const inputId = this.getAttribute("data-input");
      const inputField = document.getElementById(inputId);
      inputField.disabled = !this.checked;
      if (!this.checked) {
        inputField.value = ""; // รีเซ็ตค่าถ้า unchecked
      }
    });
  });

  // การจัดการสัปดาห์ที่สอน
  weekItems.forEach((weekItem) => {
    weekItem.addEventListener("click", function () {
      const customWeeksChecked = customWeeksCheckbox.checked;
      if (customWeeksChecked) {
        this.classList.toggle("selected");
        const checkbox = this.querySelector(".week-checkbox");
        checkbox.checked = this.classList.contains("selected");
      }
    });
  });

  allWeeksCheckbox.addEventListener("change", function () {
    if (this.checked) {
      customWeeksCheckbox.checked = false;
      weekItems.forEach((item) => {
        item.classList.add("selected");
        item.querySelector(".week-checkbox").checked = true;
      });
    } else if (!customWeeksCheckbox.checked) {
      weekItems.forEach((item) => {
        item.classList.remove("selected");
        item.querySelector(".week-checkbox").checked = false;
      });
    }
  });

  customWeeksCheckbox.addEventListener("change", function () {
    if (this.checked) {
      allWeeksCheckbox.checked = false;
      weekItems.forEach((item) => {
        item.classList.remove("selected");
        item.querySelector(".week-checkbox").checked = false;
      });
    } else if (!allWeeksCheckbox.checked) {
      weekItems.forEach((item) => {
        item.classList.remove("selected");
        item.querySelector(".week-checkbox").checked = false;
      });
    }
  });

  // การส่งฟอร์ม
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    const selectedWeeks = [];
    weekItems.forEach((item) => {
      if (item.classList.contains("selected")) {
        selectedWeeks.push(item.querySelector(".week-number").textContent);
      }
    });
    if (allWeeksCheckbox.checked) {
      for (let i = 1; i <= 15; i++) {
        selectedWeeks.push(i);
      }
    }
    formData.append("selected_weeks", selectedWeeks.join(","));

    fetch("Add_data.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log("Success:", data);
        // อาจเพิ่มการ redirect หรือแจ้งเตือนที่นี่
      })
      .catch((error) => console.error("Error:", error));
  });

  // ฟังก์ชันค้นหาข้อมูลวิชา
  window.searchCourse = function () {
    const courseId = document.getElementById("CourseID").value.trim();
    if (!courseId) {
      alert("กรุณากรอกรหัสวิชา");
      return;
    }

    // จำลองการค้นหาข้อมูล (ควรแทนที่ด้วย API จริง)
    fetch(`get_course_data.php?course_id=${encodeURIComponent(courseId)}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          alert(data.error);
          document.getElementById("Course_name").value = "";
          document.getElementById("Credit_combined").value = "";
        } else {
          document.getElementById("Course_name").value = data.Course_name || "";
          document.getElementById("Credit_combined").value =
            data.Credit_combined || "";
        }
      })
      .catch((error) => {
        console.error("Error fetching course data:", error);
        alert("เกิดข้อผิดพลาดในการค้นหาข้อมูลวิชา");
      });
  };
});
