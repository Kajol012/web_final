<?php
session_start();


$remembered_id = "";

if (isset($_COOKIE['student_id'])) {
    $remembered_id = $_COOKIE['student_id'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Workshop Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Workshop Registration</h1>

    <form id="registrationForm">

        <label>Student ID</label>
        <input type="text"
               id="student_id"
               name="student_id"
               value="<?php echo htmlspecialchars($remembered_id); ?>"
               placeholder="Example: 23-12345-1"
               required>


        <label>Student Name</label>
        <input type="text"
               id="student_name"
               name="student_name"
               placeholder="Enter your name"
               required>


        <label>Email</label>
        <input type="email"
               id="email"
               name="email"
               placeholder="Enter your email"
               required>


        <label>Department</label>
        <select id="department" name="department" required>

            <option value="">Select Department</option>

            <option value="Computer Science">
                Computer Science
            </option>

            <option value="Electrical Engineering">
                Electrical Engineering
            </option>

            <option value="Business Administration">
                Business Administration
            </option>

            <option value="English">
                English
            </option>

        </select>


        <label>Select Workshop</label>

        <select id="workshop" name="workshop_id" required>

            <option value="">
                Loading workshops...
            </option>

        </select>


        <div class="remember">

            <input type="checkbox"
                   id="remember"
                   name="remember">

            <span>Remember Student ID</span>

        </div>


        <button type="submit">
           Register
        </button>

    </form>


    <div id="message"></div>


    <a href="my_registration.php" class="link">
        View My Registration
    </a>

</div>

<script src="script.js"></script>

</body>
</html>