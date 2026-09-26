<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Summary</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Registration Summary</h1>

    <div class="summary">

        <h3>Session Information</h3>

        <p>
            <strong>Student ID:</strong>
            <?php echo htmlspecialchars($_SESSION['student_id']); ?>
        </p>

        <p>
            <strong>Name:</strong>
            <?php echo htmlspecialchars($_SESSION['name']); ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?php echo htmlspecialchars($_SESSION['email']); ?>
        </p>

        <p>
            <strong>Department:</strong>
            <?php echo htmlspecialchars($_SESSION['department']); ?>
        </p>

        <p>
            <strong>Semester:</strong>
            <?php echo htmlspecialchars($_SESSION['semester']); ?>
        </p>

        <p>
            <strong>Course:</strong>
            <?php echo htmlspecialchars($_SESSION['course']); ?>
        </p>

        <p>
            <strong>Credits:</strong>
            <?php echo htmlspecialchars($_SESSION['credits']); ?>
        </p>

    </div>


    <div class="cookie-box">

        <h3>Cookie Information</h3>

        <?php

        if (isset($_COOKIE['student_id'])) {

            echo "<p><strong>Remembered Student ID:</strong> "
                 . htmlspecialchars($_COOKIE['student_id'])
                 . "</p>";

        } else {

            echo "<p>No Student ID cookie found.</p>";
        }

        ?>

    </div>


    <form action="complete.php" method="POST">

        <button type="submit">
            Complete Registration
        </button>

    </form>

</div>

</body>
</html>