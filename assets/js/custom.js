 document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll(".form-step");
     const nextBtns = document.querySelectorAll(".next-btn");
     const prevBtns = document.querySelectorAll(".prev-btn");

     let currentStep = 0;

    nextBtns.forEach(button => {
        button.addEventListener("click", () => {
            steps[currentStep].style.display = "none";
            currentStep++;
             steps[currentStep].style.display = "block";
        });
     });

    prevBtns.forEach(button => {
        button.addEventListener("click", () => {
             steps[currentStep].style.display = "none";
            currentStep--;
             steps[currentStep].style.display = "block";
         });
    });
 });

 function addQualificationRow() {
     const table = document.getElementById("education-qualifications");
    const newRow = table.insertRow();

     const fields = ["exam_name[]", "institute_name[]", "major_discipline[]", "year_of_passing[]", "total_marks_obtained[]", "full_marks[]", "percentage_marks[]"];
     fields.forEach(field => {
        const cell = newRow.insertCell();
         const input = document.createElement("input");
        input.type = "text";
        input.name = field;
        input.required = true;
         cell.appendChild(input);
     });
 }

 function addWorkExperienceRow() {
    const table = document.getElementById("work-experience");
     const newRow = table.insertRow();

     const fields = ["organization[]", "position[]", "period_from[]", "period_to[]", "responsibilities[]"];
     fields.forEach(field => {
        const cell = newRow.insertCell();
         const input = document.createElement("input");
        input.type = "text";
       input.name = field;
        input.required = true;
         if (field === "period_from[]" || field === "period_to[]") {
             input.type = "date";
        }
        cell.appendChild(input);
    });
 }

