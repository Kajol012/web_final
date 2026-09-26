
<?php
session_start();


if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}


$student_id = $_SESSION['student_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$department = $_SESSION['department'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['semester'] = $_POST['semester'];
    $_SESSION['course'] = $_POST['course'];
    $_SESSION['credits'] = $_POST['credits'];

    // Go to summary page
    header("Location: summary.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Academic Information</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Academic Registration</h1>

    <div class="student-info">

        <h3>Student Information</h3>

        <p><strong>Student ID:</strong>
            <?php echo htmlspecialchars($student_id); ?>
        </p>

        <p><strong>Name:</strong>
            <?php echo htmlspecialchars($name); ?>
        </p>

        <p><strong>Email:</strong>
            <?php echo htmlspecialchars($email); ?>
        </p>

        <p><strong>Department:</strong>
            <?php echo htmlspecialchars($department); ?>
        </p>

    </div>

    <form method="POST">

        <label>Semester</label>
        <select name="semester" required>
            <option value="">Select Semester</option>
            <option value="1st Semester">1st Semester</option>
            <option value="2nd Semester">2nd Semester</option>
            <option value="3rd Semester">3rd Semester</option>
            <option value="4th Semester">4th Semester</option>
            <option value="5th Semester">5th Semester</option>
            <option value="6th Semester">6th Semester</option>
            <option value="7th Semester">7th Semester</option>
            <option value="8th Semester">8th Semester</option>
        </select>

        <label>Course Selection</label>
        <select name="course" required>
            <option value="">Select Course</option>
            <option value="Web Technology">Web Technology</option>
            <option value="Operating System">Operating System</option>
            <option value="Database Management System">
                Database Management System
            </option>
            <option value="Computer Networks">Computer Networks</option>
        </select>

        <label>Credit Information</label>
        <input type="number"
               name="credits"
               min="1"
               max="6"
               placeholder="Enter credit"
               required>

        <button type="submit">Continue</button>

    </form>

    <a href="index.php" class="back-link">Back</a>

</div>

</body>
</html>