<?php
session_start();


$remembered_id = "";

if (isset($_COOKIE['student_id'])) {
    $remembered_id = $_COOKIE['student_id'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

   
    $_SESSION['student_id'] = $student_id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['department'] = $department;

   
    if (isset($_POST['remember'])) {

        setcookie("student_id", $student_id, time() + (86400 * 30), "/");

    } else {

        // Delete cookie if Remember option is not selected
        setcookie("student_id", "", time() - 3600, "/");
    }


    header("Location: academic.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>University Portal Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>University Portal</h1>
    <h2>Student Registration</h2>

    <form method="POST">

        <label>Student ID</label>
        <input type="text"
               name="student_id"
               value="<?php echo htmlspecialchars($remembered_id); ?>"
               required>

        <label>Student Name</label>
        <input type="text"
               name="name"
               placeholder="Enter your name"
               required>

        <label>Email</label>
        <input type="email"
               name="email"
               placeholder="Enter your email"
               required>

        <label>Department</label>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Business Administration">Business Administration</option>
            <option value="English">English</option>
        </select>

        <div class="remember">
            <input type="checkbox" name="remember">
            <span>Remember Student ID</span>
        </div>

        <button type="submit">Next</button>

    </form>

</div>

</body>
</html>