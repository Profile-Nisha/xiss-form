<?php
include_once 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fpm = $_POST['fpm'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $religion = $_POST['religion'];
    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $disability_percentage = isset($_POST['disability_percentage']) ? $_POST['disability_percentage'] : '';
    $nationality = $_POST['nationality'];
    $marital_status = $_POST['marital_status'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $permanent_address = $_POST['permanent_address'];
    $permanent_post_office = $_POST['permanent_post_office'];
    $permanent_police_station = $_POST['permanent_police_station'];
    $permanent_pin = $_POST['permanent_pin'];
    $communication_address = isset($_POST['communication_address']) ? $_POST['communication_address'] : '';
    $communication_post_office = isset($_POST['communication_post_office']) ? $_POST['communication_post_office'] : '';
    $communication_police_station = isset($_POST['communication_police_station']) ? $_POST['communication_police_station'] : '';
    $communication_pin = isset($_POST['communication_pin']) ? $_POST['communication_pin'] : '';
    $mobile = $_POST['mobile'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = $_POST['email'];
    $statement_of_purpose = $_POST['statement_of_purpose'];
    $additional_information = isset($_POST['additional_information']) ? $_POST['additional_information'] : '';
    $exam = $_POST['exam'];
    $discipline = $_POST['discipline'];
    $score = $_POST['score'];
    $percentile = $_POST['percentile'];
    $declaration = isset($_POST['declaration']) ? 1 : 0;

    $uploadDir = 'uploads/'; // Directory where files will be uploaded
    $photoPath = '';
    $signaturePath = '';
    $otherQualificationPath = '';
    $publicationsPath = '';

    if ($_FILES['photo']['size'] > 0) {
        $photoFileName = basename($_FILES['photo']['name']);
        $photoPath = $uploadDir . $photoFileName;
        $photoUploadSuccess = move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
        if (!$photoUploadSuccess) {
            echo "Error uploading photo.";
            exit;
        }
    }

    if ($_FILES['signature']['size'] > 0) {
        $signatureFileName = basename($_FILES['signature']['name']);
        $signaturePath = $uploadDir . $signatureFileName;
        $signatureUploadSuccess = move_uploaded_file($_FILES['signature']['tmp_name'], $signaturePath);
        if (!$signatureUploadSuccess) {
            echo "Error uploading signature.";
            exit;
        }
    }

    if ($_FILES['other_qualification']['size'] > 0) {
        $otherQualificationFileName = basename($_FILES['other_qualification']['name']);
        $otherQualificationPath = $uploadDir . $otherQualificationFileName;
        $otherQualificationUploadSuccess = move_uploaded_file($_FILES['other_qualification']['tmp_name'], $otherQualificationPath);
        if (!$otherQualificationUploadSuccess) {
            echo "Error uploading other qualification.";
            exit;
        }
    }

    if ($_FILES['publications']['size'] > 0) {
        $publicationsFileName = basename($_FILES['publications']['name']);
        $publicationsPath = $uploadDir . $publicationsFileName;
        $publicationsUploadSuccess = move_uploaded_file($_FILES['publications']['tmp_name'], $publicationsPath);
        if (!$publicationsUploadSuccess) {
            echo "Error uploading publications.";
            exit;
        }
    }


    $examNames = $_POST['exam_name'];
    $instituteNames = $_POST['institute_name'];
    $majorDisciplines = $_POST['major_discipline'];
    $yearsOfPassing = $_POST['year_of_passing'];
    $totalMarksObtained = $_POST['total_marks_obtained'];
    $fullMarks = $_POST['full_marks'];
    $percentageMarks = $_POST['percentage_marks'];

    // Prepare for batch insert
    $sqlValues = [];
    for ($i = 0; $i < count($examNames); $i++) {
        // Escape values to prevent SQL injection
        $examName = mysqli_real_escape_string($conn, $examNames[$i]);
        $instituteName = mysqli_real_escape_string($conn, $instituteNames[$i]);
        $majorDiscipline = mysqli_real_escape_string($conn, $majorDisciplines[$i]);
        $yearOfPassing = mysqli_real_escape_string($conn, $yearsOfPassing[$i]);
        $marksObtained = mysqli_real_escape_string($conn, $totalMarksObtained[$i]);
        $fullMarksValue = mysqli_real_escape_string($conn, $fullMarks[$i]);
        $percentage = mysqli_real_escape_string($conn, $percentageMarks[$i]);

        // Prepare SQL values for batch insert
        $sqlValues[] = "('$fpm', '$examName', '$instituteName', '$majorDiscipline', '$yearOfPassing', '$marksObtained', '$fullMarksValue', '$percentage')";
    }

    // Insert into database
    $sql = "INSERT INTO form (fpm, exam_name[], institute_name[], major_discipline[], year_of_passing[], total_marks_obtained[], full_marks[], percentage_marks[])
            VALUES " . implode(", ", $sqlValues);



    $sql = "INSERT INTO form (fpm, fullname, dob, gender, category, religion, pwd, disability_percentage,
    nationality, marital_status, father_name, mother_name, permanent_address, permanent_post_office,
    permanent_police_station, permanent_pin, communication_address, communication_post_office,
    communication_police_station, communication_pin, mobile, phone, email, statement_of_purpose,
    additional_information, exam, discipline, score, percentile, declaration, photo_path, signature_path,
    other_qualification_path, publications_path)
    VALUES ('$fpm', '$fullname', '$dob', '$gender', '$category', '$religion', '$pwd', '$disability_percentage',
    '$nationality', '$marital_status', '$father_name', '$mother_name', '$permanent_address', '$permanent_post_office',
    '$permanent_police_station', '$permanent_pin', '$communication_address', '$communication_post_office',
    '$communication_police_station', '$communication_pin', '$mobile', '$phone', '$email', '$statement_of_purpose',
    '$additional_information', '$exam', '$discipline', '$score', '$percentile', '$declaration', '$photoPath', '$signaturePath',
    '$otherQualificationPath', '$publicationsPath')";
    if ($conn->query($sql) === TRUE) {
        echo "Application submitted successfully.";
        header('location:success.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form for FPM – 2024</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="header">
            <img src="assets/images/XISS_BrandLogo.png" alt="Xavier Institute of Social Service Logo" class="logo">
            <h1>XAVIER INSTITUTE OF SOCIAL SERVICE</h1>
            <p>Dr. Camil Bulcke Path (Purulia Road) Ranchi, 834001,</p>
            <p>Jharkhand, India</p>
            <h2>Application Form for FELLOW PROGRAMME IN MANAGEMENT – 2024</h2>
            <p>For technical queries or support, please feel free to contact us at: 6209009007</p>
        </div>
    </div>


    <form id="application-form" action="index.php" method="post" enctype="multipart/form-data">
        <div class="form-step">
            <div class="form-section">
                <h3>1. Fellow Programme applying for (tick the appropriate)*</h3>
                <div class="form-group">
                    <label><input type="radio" name="fpm" value="HRM"> FPM. in Human Resource Management</label><br>
                    <label><input type="radio" name="fpm" value="RM"> FPM. in Rural Management</label><br>
                    <label><input type="radio" name="fpm" value="MM"> FPM. in Marketing Management</label><br>
                    <label><input type="radio" name="fpm" value="FM"> FPM. in Financial Management</label><br>
                    <label><input type="radio" name="fpm" value="OM"> FPM. in Operation Management</label>
                </div>

                <h3>2. Personal Information:</h3>
                <!-- Personal Information Fields -->
                <div class="form-group">
                    <label>Full Name (in Block Letters): *</label>
                    <input type="text" name="fullname" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth (dd/mm/yyyy): *</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="form-group">
                    <label>Gender: *</label>
                    <select name="gender" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Category: *</label>
                    <select name="category" required>
                        <option value="">Select</option>
                        <option value="General">General</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                        <option value="OBC-A">OBC-A</option>
                        <option value="OBC-B">OBC-B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Religion: *</label>
                    <select name="religion" required>
                        <option value="">Select</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Christian">Christian</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Whether Person with Disability: *</label>
                    <label><input type="radio" name="pwd" value="Yes"> Yes</label>
                    <label><input type="radio" name="pwd" value="No"> No</label>
                    <input type="text" name="disability_percentage" placeholder="Percentage of disability">
                </div>
                <div class="form-group">
                    <label>Nationality: *</label>
                    <input type="text" name="nationality" required>
                </div>
                <div class="form-group">
                    <label>Marital Status: *</label>
                    <select name="marital_status" required>
                        <option value="">Select</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Father’s/Husband’s Name (in Block Letters): *</label>
                    <input type="text" name="father_name" required>
                </div>
                <div class="form-group">
                    <label>Mother’s Name (in Block Letters): *</label>
                    <input type="text" name="mother_name" required>
                </div>
                <div class="form-group">
                    <label>Permanent Address:</label>
                    <input type="text" name="permanent_address" required>
                </div>
                <div class="form-group">
                    <label>Post Office: *</label>
                    <input type="text" name="permanent_post_office" required>
                </div>
                <div class="form-group">
                    <label>Police Station: *</label>
                    <input type="text" name="permanent_police_station" required>
                </div>
                <div class="form-group">
                    <label>PIN No.: *</label>
                    <input type="text" name="permanent_pin" required>
                </div>
                <div class="form-group">
                    <label>Address for Communication: </label>
                    <label><input type="checkbox" name="same_address"> Same as Permanent Address</label>
                    <input type="text" name="communication_address">
                </div>
                <div class="form-group">
                    <label>Post Office: *</label>
                    <input type="text" name="communication_post_office">
                </div>
                <div class="form-group">
                    <label>Police Station: *</label>
                    <input type="text" name="communication_police_station">
                </div>
                <div class="form-group">
                    <label>PIN No.: *</label>
                    <input type="text" name="communication_pin">
                </div>
                <div class="form-group">
                    <label>Mobile No.: *</label>
                    <input type="text" name="mobile" required>
                </div>
                <div class="form-group">
                    <label>Phone No.:</label>
                    <input type="text" name="phone">
                </div>
                <div class="form-group">
                    <label>Email: *</label>
                    <input type="email" name="email" required>
                </div>
            </div>
            <button type="button" class="next-btn">Next</button>
        </div>

        <div class="form-step" style="display: none;">
            <div class="form-section">
                <h3>3. Educational Qualifications:*</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name of Examination *</th>
                            <th>Name of Institute/Board/University *</th>
                            <th>Major Discipline *</th>
                            <th>Year of Passing *</th>
                            <th>Total Marks Obtained *</th>
                            <th>Full Marks *</th>
                            <th>% of Marks/Grade Point *</th>
                        </tr>
                    </thead>
                    <tbody id="education-qualifications">
                        <tr>
                            <td><input type="text" name="exam_name[]" required></td>
                            <td><input type="text" name="institute_name[]" required></td>
                            <td><input type="text" name="major_discipline[]" required></td>
                            <td><input type="text" name="year_of_passing[]" required></td>
                            <td><input type="text" name="total_marks_obtained[]" required></td>
                            <td><input type="text" name="full_marks[]" required></td>
                            <td><input type="text" name="percentage_marks[]" required></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" onclick="addQualificationRow()">Add More</button>
            </div>

            <div class="form-section">
                <h3>4. Any other qualification, if any (Certificate, Diploma etc. Attach relevant proof):</h3>
                <input type="file" name="other_qualification" accept="application/pdf">
            </div>

            <div class="form-section">
                <h3>5. (A) CAT/XAT/UGC NET/ CSIR NET / SET / SLET /GATE (if any):</h3>
                <div class="form-group">
                    <label>Examination:</label>
                    <input type="text" name="exam" required>
                </div>
                <div class="form-group">
                    <label>Discipline:</label>
                    <input type="text" name="discipline" required>
                </div>
                <div class="form-group">
                    <label>Score:</label>
                    <input type="text" name="score" required>
                </div>
                <div class="form-group">
                    <label>Percentile:</label>
                    <input type="text" name="percentile" required>
                </div>
            </div>

            <div class="form-section">
                <h3>(B) Details of Work Experience, if any: *</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Organization *</th>
                            <th>Position Held *</th>
                            <th>Period (From) *</th>
                            <th>Period (To) *</th>
                            <th>Responsibilities *</th>
                        </tr>
                    </thead>
                    <tbody id="work-experience">
                        <tr>
                            <td><input type="text" name="organization[]" required></td>
                            <td><input type="text" name="position[]" required></td>
                            <td><input type="date" name="period_from[]" required></td>
                            <td><input type="date" name="period_to[]" required></td>
                            <td><input type="text" name="responsibilities[]" required></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" onclick="addWorkExperienceRow()">Add More</button>
            </div>
            <button type="button" class="prev-btn">Previous</button>
            <button type="button" class="next-btn">Next</button>
        </div>

        <div class="form-step" style="display: none;">
            <div class="form-section">
                <h3>6. Briefly state why you would like to join the FPM Programme at XISS. (Please attach separate sheets if necessary)*</h3>
                <div class="form-group">
                    <textarea name="statement_of_purpose" rows="4" required></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>7. Publications (if any):</h3>
                <input type="file" name="publications" accept="application/pdf">
            </div>

            <div class="form-section">
                <h3>8. Any other information you wish to share:</h3>
                <div class="form-group">
                    <textarea name="additional_information" rows="4"></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>9. Declaration:</h3>
                <div class="form-group">
                    <label><input type="checkbox" name="declaration" required> I hereby declare that the information given above is true to the best of my knowledge and belief. I understand that any false information or misrepresentation will result in the rejection of my application.</label>
                </div>
            </div>

            <div class="form-section">
                <h3>Upload Passport Size Photo (Max 500 KB) *</h3>
                <div class="form-group">
                    <input type="file" name="photo" accept="image/*" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Upload Signature (Max 200 KB) *</h3>
                <div class="form-group">
                    <input type="file" name="signature" accept="image/*" required>
                </div>
            </div>

            <button type="button" class="prev-btn">Previous</button>
            <button type="submit">Submit</button>
        </div>
    </form>

    <script src="assets/js/custom.js"></script>
</body>

</html>