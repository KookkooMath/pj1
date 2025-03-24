// กำหนดข้อมูลคณะและสาขา
const departments = {
  วิทย์: [
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
  วิศวะ: [
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
    "B.Eng. Biomedical Engineering (Internation Program)",
    "B.Eng. Robotics and AI Engineering (Internation Program)",
    "B. Eng. Financial Enineering (International Program)",
    "B.Eng. Software Engineering (International Program)",
    "B.Eng. Civil Engineering (International Program)",
    "B.Eng. Mechanical Engineering (International Program)",
    "B.Eng. Chemical Engineering (International Program)",
    "B.Eng. Industrial Engineering and Logistics Management (International Program)",
    "B.Eng. Engineering Management and Entrepreneurship (Internation Program)",
    "B.Eng. Electrical Engineering (Internation Program)",
    "B.Eng. Energy Engineering (Internation Program)",
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

const facultySelect = document.getElementById("Student_faculty");
const departmentSelect = document.getElementById("Student_department");

facultySelect.addEventListener("change", function () {
  const selectedFaculty = this.value;
  departmentSelect.innerHTML = '<option value="">-- เลือกสาขา --</option>'; // รีเซ็ต dropdown สาขา

  if (selectedFaculty) {
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

document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll(".course-checkbox");

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      checkboxes.forEach((cb) => {
        if (cb !== this) {
          cb.checked = false;
          const inputField = document.getElementById(
            cb.getAttribute("data-input")
          );
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
    event.preventDefault(); 

    const formData = new FormData(this);

    fetch("Add_data.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .catch((error) => console.error("Error:", error));
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Get existing week items instead of creating new ones
  const weekItems = document.querySelectorAll(".week-item");

  // Add event listeners to the existing week items
  weekItems.forEach((weekItem) => {
    weekItem.addEventListener("click", function () {
      // ตรวจสอบว่าทำงานในโหมดไหน
      const customWeeksChecked =
        document.getElementById("custom-weeks").checked;
      const allWeeksChecked = document.getElementById("all-weeks").checked;

      if (customWeeksChecked) {
        // Toggle selected class สำหรับสัปดาห์ที่คลิก
        this.classList.toggle("selected");
      } else if (allWeeksChecked) {
        // ในโหมด "ทุกสัปดาห์" ไม่อนุญาตให้เปลี่ยนแปลง
        return;
      }
    });
  });

  // สร้าง Event Listeners สำหรับตัวเลือก "ทุกสัปดาห์" และ "เลือกเอง"
  const allWeeksCheckbox = document.getElementById("all-weeks");
  const customWeeksCheckbox = document.getElementById("custom-weeks");

  allWeeksCheckbox.addEventListener("change", function () {
    if (this.checked) {
      customWeeksCheckbox.checked = false;

      // เลือกทุกสัปดาห์
      weekItems.forEach((item) => {
        item.classList.add("selected");
      });
    } else if (!customWeeksCheckbox.checked) {
      // รีเซ็ตทุกสัปดาห์ถ้าไม่ได้เลือกทั้งสองตัวเลือก
      weekItems.forEach((item) => {
        item.classList.remove("selected");
      });
    }
  });

  customWeeksCheckbox.addEventListener("change", function () {
    if (this.checked) {
      allWeeksCheckbox.checked = false;

      // รีเซ็ตทุกสัปดาห์เพื่อให้ผู้ใช้เลือกใหม่
      weekItems.forEach((item) => {
        item.classList.remove("selected");
      });
    } else if (!allWeeksCheckbox.checked) {
      // รีเซ็ตทุกสัปดาห์ถ้าไม่ได้เลือกทั้งสองตัวเลือก
      weekItems.forEach((item) => {
        item.classList.remove("selected");
      });
    }
  });

  // เมื่อ form ถูก submit ให้เก็บข้อมูลสัปดาห์ที่เลือก
  const form = document.querySelector("form");
  form.addEventListener("submit", function (event) {
    // สร้าง hidden inputs สำหรับเก็บข้อมูลสัปดาห์ที่เลือก
    const selectedWeeks = [];

    if (allWeeksCheckbox.checked) {
      // ถ้าเลือก "ทุกสัปดาห์" ให้เพิ่มทุกสัปดาห์
      for (let i = 1; i <= 15; i++) {
        selectedWeeks.push(i);
      }
    } else if (customWeeksCheckbox.checked) {
      // ถ้าเลือก "เลือกเอง" ให้ตรวจสอบแต่ละสัปดาห์ที่เลือก
      weekItems.forEach((item) => {
        if (item.classList.contains("selected")) {
          const weekNumber = item.querySelector(".week-number").textContent;
          selectedWeeks.push(weekNumber);
        }
      });
    }

    // เพิ่ม hidden input สำหรับส่งข้อมูลสัปดาห์ที่เลือก
    const selectedWeeksInput = document.createElement("input");
    selectedWeeksInput.type = "hidden";
    selectedWeeksInput.name = "selected_weeks";
    selectedWeeksInput.value = selectedWeeks.join(",");
    form.appendChild(selectedWeeksInput);
  });
});
